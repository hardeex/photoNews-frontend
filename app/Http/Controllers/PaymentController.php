<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function initiate(Request $request, $postType, $slug)
{
    try {
        $jwtToken = session('api_token');
        if (!$jwtToken) {
            Log::warning("User tried to initiate payment without a JWT token");
            return redirect()->route('user.login')->with('error', 'Please log in first.');
        }

        Log::info("Starting payment initiation", [
            'post_type' => $postType,
            'slug' => $slug,
            'user_token' => substr($jwtToken, 0, 10) . '...',
        ]);

        // STEP 1: Get post type info to determine model_class
        $postTypeResponse = Http::withToken($jwtToken)
            ->get(config('api.base_url') . "/post-types/{$postType}");

        if (!$postTypeResponse->successful()) {
            Log::error("Failed to fetch post type from backend", [
                'post_type' => $postType,
                'response' => $postTypeResponse->body(),
            ]);
            return back()->with('error', 'Invalid post type selected.');
        }

        $postTypeData = $postTypeResponse->json()['data'] ?? null;
        if (!$postTypeData || !$postTypeData['is_active']) {
            Log::warning("Inactive or missing post type returned", [
                'postTypeData' => $postTypeData,
            ]);
            return back()->with('error', 'This post type is inactive or not found.');
        }

        $postModel = $postTypeData['model_class'];

        // STEP 2: Get post by slug
        $postResponse = Http::withToken($jwtToken)
            ->get(config('api.base_url') . "/{$postType}/posts/{$slug}");

        if (!$postResponse->successful()) {
            Log::error("Failed to fetch post by slug", [
                'slug' => $slug,
                'response' => $postResponse->body(),
            ]);
            return back()->with('error', 'Post not found.');
        }

        $postData = $postResponse->json()['data'] ?? null;
        if (!$postData) {
            Log::error("Empty post data returned from backend", [
                'slug' => $slug,
                'postType' => $postType,
            ]);
            return back()->with('error', 'Unable to retrieve post details.');
        }

        // STEP 3: Call backend to initiate payment
        $initiateResponse = Http::withToken($jwtToken)->post(
            config('api.base_url') . "/payments/initiate/{$postType}",
            [
                'post_id' => $postData['id'],
                'post_model' => $postModel,
                'return_url' => url()->current(),
            ]
        );

        Log::info("Backend payment initiation response", [
            'status' => $initiateResponse->status(),
            'body' => $initiateResponse->json(),
        ]);

        if ($initiateResponse->successful()) {
            $data = $initiateResponse->json()['data'] ?? [];
            if (!empty($data['has_paid']) && $data['has_paid']) {
                Log::info("User already paid for this post", [
                    'post_id' => $data['post_id'],
                    'payment_id' => $data['payment_id'] ?? null,
                ]);
                return redirect()->route('user.dashboard')->with('success', 'Payment already made. Post is published.');
            }

            if (!empty($data['payment_url'])) {
                Log::info("Redirecting user to Paystack", ['url' => $data['payment_url']]);
                return redirect()->away($data['payment_url']);
            }

            Log::warning("Payment URL missing in successful response", ['data' => $data]);
            return back()->with('error', 'Failed to get payment URL.');
        }

        $message = $initiateResponse->json()['message'] ?? 'Unable to initiate payment.';
        Log::error("Backend failed to initiate payment", [
            'status' => $initiateResponse->status(),
            'message' => $message,
            'post_type' => $postType,
        ]);

        return back()->with('error', $message);
    } catch (\Exception $e) {
        Log::error('Frontend payment initiation crashed', [
            'exception' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return back()->with('error', 'An unexpected error occurred. Please try again.');
    }
}

}
