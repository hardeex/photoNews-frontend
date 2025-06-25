<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeController extends Controller
{
    public function showCurrency()
    {
        try {
            $response = Http::get('https://open.er-api.com/v6/latest/USD');
            $data = $response->json();

            // Debug to verify API response
            Log::info('API Response:', $data);

            $rates = [
                ['base' => 'USD', 'target' => 'EUR', 'value' => $data['rates']['EUR'] ?? 0.92],
                ['base' => 'USD', 'target' => 'GBP', 'value' => $data['rates']['GBP'] ?? 0.79],
                ['base' => 'USD', 'target' => 'JPY', 'value' => $data['rates']['JPY'] ?? 134.56],
                ['base' => 'USD', 'target' => 'CAD', 'value' => $data['rates']['CAD'] ?? 1.35],
                ['base' => 'USD', 'target' => 'AUD', 'value' => $data['rates']['AUD'] ?? 1.48],
                ['base' => 'USD', 'target' => 'CHF', 'value' => $data['rates']['CHF'] ?? 0.88],
                ['base' => 'USD', 'target' => 'CNY', 'value' => $data['rates']['CNY'] ?? 7.24],
                ['base' => 'USD', 'target' => 'INR', 'value' => $data['rates']['INR'] ?? 83.45],
                ['base' => 'USD', 'target' => 'NGN', 'value' => $data['rates']['NGN'] ?? 1625.3],
            ];
        } catch (\Exception $e) {
            Log::error('API Error:', ['error' => $e->getMessage()]);
            $rates = [
                ['base' => 'USD', 'target' => 'EUR', 'value' => 0.92],
                ['base' => 'USD', 'target' => 'GBP', 'value' => 0.79],
                ['base' => 'USD', 'target' => 'JPY', 'value' => 134.56],
                ['base' => 'USD', 'target' => 'CAD', 'value' => 1.35],
                ['base' => 'USD', 'target' => 'AUD', 'value' => 1.48],
                ['base' => 'USD', 'target' => 'CHF', 'value' => 0.88],
                ['base' => 'USD', 'target' => 'CNY', 'value' => 7.24],
                ['base' => 'USD', 'target' => 'INR', 'value' => 83.45],
                ['base' => 'USD', 'target' => 'NGN', 'value' => 1625.3],
            ];
        }

        return view('exchange-rate.exchange-rate', compact('rates'));
    }



// public function startPayment(Request $request, $post_type)
// {
//     $token = session('api_token');

//     if (!$token) {
//         return redirect()->route('login')->with('error', 'Authentication token missing.');
//     }

//     try {
//         $response = Http::withHeaders([
//             'Authorization' => 'Bearer ' . $token,
//             'Accept' => 'application/json',
//         ])->post(config('api.base_url') . "/payments/initiate/{$post_type}");

//         if ($response->successful()) {
//             $data = $response->json();
//             if (isset($data['data']['payment_url'])) {
//                 return redirect()->away($data['data']['payment_url']);
//             }
//         }

//         return redirect()->back()->with('error', 'Failed to initiate payment.');
//     } catch (\Exception $e) {
//         Log::error('Error initiating payment', ['error' => $e->getMessage()]);
//         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
//     }
// }


public function startPayment(Request $request, $post_type)
{
    $token = session('api_token');

    if (!$token) {
        Log::warning('Missing API token for payment initiation', [
            'user_id' => auth()->id(),
            'post_type' => $post_type,
        ]);
        return redirect()->route('login')->with('error', 'Authentication token missing.');
    }

    $postTypeRoutes = [
        'birthday' => '/create/birthday',
        'caveat' => '/create/caveat',
        'change_of_name' => '/create/change-of-name',
        'dedication' => '/create/dedication',
        'lost_and_found' => '/create/lost-and-found',
        'missing_and_wanted' => '/create/missing-and-wanted',
        'obituary' => '/create/obituary',
        'public_notice' => '/create/public-notice',
        'remembrance' => '/create/remembrance',
        'stolen_vehicle' => '/create/stolen-vehicle',
        'wedding' => '/create/wedding',
    ];

    $returnUrl = config('app.url') . ($postTypeRoutes[$post_type] ?? '/');

    Log::info('Initiating payment', [
        'user_id' => auth()->id(),
        'post_type' => $post_type,
        'return_url' => $returnUrl,
    ]);

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post(config('api.base_url') . "/payments/initiate/{$post_type}", [
            'return_url' => $returnUrl,
        ]);

        Log::debug('Payment initiation response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']['payment_url'])) {
                Log::info('Redirecting to payment URL', [
                    'payment_url' => $data['data']['payment_url'],
                ]);
                return redirect()->away($data['data']['payment_url']);
            }
        }

        Log::warning('Payment initiation failed or payment_url not found', [
            'response' => $response->json(),
        ]);

        return redirect()->route('payment.initiate')->with('error', 'Failed to initiate payment.');
    } catch (\Exception $e) {
        Log::error('Error initiating payment', [
            'error' => $e->getMessage(),
            'post_type' => $post_type,
        ]);

        return redirect()->route('payment.initiate')->with('error', 'Something went wrong. Please try again.');
    }
}

public function startPaymentww(Request $request, $post_type)
{
    Log::info('Starting payment initiation for post type', [
        'post_type' => $post_type,
    ]);

    $token = session('api_token');

    if (!$token) {
        Log::warning('JWT token missing from session');
        return redirect()->route('login')->with('error', 'Authentication token missing.');
    }

    // Map post types to frontend routes
    $postTypeRoutes = [
        'birthday' => '/create/birthday',
        'caveat' => '/create/caveat',
        'change_of_name' => '/create/change-of-name',
        'dedication' => '/create/dedication',
        'lost_and_found' => '/create/lost-and-found',
        'missing_and_wanted' => '/create/missing-and-wanted',
        'obituary' => '/create/obituary',
        'public_notice' => '/create/public-notice',
        'remembrance' => '/create/remembrance',
        'stolen_vehicle' => '/create/stolen-vehicle',
        'wedding' => '/create/wedding',
    ];

    // Set return_url based on post type
    $returnUrl = config('app.url') . ($postTypeRoutes[$post_type] ?? '/');

    try {
        // Create a draft post via API
        $postResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post(config('api.base_url') . "/posts/create-draft/{$post_type}");

        if (!$postResponse->successful()) {
            Log::error('Failed to create draft post', [
                'post_type' => $post_type,
                'status' => $postResponse->status(),
                'response' => $postResponse->body(),
            ]);
            return redirect()->route('payment.initiate')->with('error', 'Failed to create draft post.');
        }

        $postData = $postResponse->json();
        $postId = $postData['data']['post_id'] ?? null;
        $postModel = $postData['data']['post_model'] ?? null;

        if (!$postId || !$postModel) {
            Log::error('Post ID or model not returned from draft post creation', [
                'post_type' => $post_type,
                'response_data' => $postData,
            ]);
            return redirect()->route('payment.initiate')->with('error', 'Failed to create draft post.');
        }

        Log::info('Draft post created successfully', [
            'post_type' => $post_type,
            'post_id' => $postId,
            'post_model' => $postModel,
        ]);

        // Initiate payment with post_id and post_model
        $paymentResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post(config('api.base_url') . "/payments/initiate/{$post_type}", [
            'return_url' => $returnUrl,
            'post_id' => $postId,
            'post_model' => $postModel,
        ]);

        if (!$paymentResponse->successful()) {
            Log::error('Failed to initiate payment', [
                'post_type' => $post_type,
                'status' => $paymentResponse->status(),
                'response' => $paymentResponse->body(),
            ]);
            return redirect()->route('payment.initiate')->with('error', 'Failed to initiate payment.');
        }

        $paymentData = $paymentResponse->json();
        if (isset($paymentData['data']['payment_url'])) {
            Log::info('Payment initiated, redirecting to Paystack', [
                'payment_url' => $paymentData['data']['payment_url'],
                'payment_id' => $paymentData['data']['payment_id'],
            ]);
            return redirect()->away($paymentData['data']['payment_url']);
        }

        Log::warning('Payment URL not found in response', ['response_data' => $paymentData]);
        return redirect()->route('payment.initiate')->with('error', 'Failed to initiate payment.');
    } catch (\Exception $e) {
        Log::error('Error initiating payment', [
            'post_type' => $post_type,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return redirect()->route('payment.initiate')->with('error', 'Something went wrong. Please try again.');
    }
}



    public function createPost22(Request $request, $post_type)
    {
        try {
            Log::info("Starting createPost for {$post_type}");

            // Map post types to view names
            $postTypeViews = [
                'birthday' => 'birthday.create',
                'caveat' => 'caveat.create',
                'change_of_name' => 'change-of-name.create',
                'dedication' => 'dedication.create',
                'lost_and_found' => 'lost-and-found.create',
                'missing_and_wanted' => 'missing-and-wanted.create',
                'obituary' => 'obituary.create',
                'public_notice' => 'public-notice.create',
                'remembrance' => 'remembrance.create',
                'stolen_vehicle' => 'stolen-vehicle.create',
                'wedding' => 'wedding.create',
            ];

            // Handle payment status from query parameters
            if ($request->query('status') === 'success' && $request->query('payment_id')) {
                Log::info('User redirected with successful payment', [
                    'post_type' => $post_type,
                    'payment_id' => $request->query('payment_id'),
                ]);
                return view($postTypeViews[$post_type] ?? 'errors.404', [
                    'payment_id' => $request->query('payment_id'),
                ]);
            } elseif ($request->query('status') === 'failed') {
                Log::warning('Payment failed as per query parameter', [
                    'post_type' => $post_type,
                    'payment_id' => $request->query('payment_id'),
                ]);
                return redirect()->route('payment.initiate')->with('error', 'Payment failed. Please try again.');
            }

            $token = session('api_token');
            if (!$token) {
                Log::warning('JWT token missing from session');
                return redirect()->route('login')->with('error', 'Authentication token missing.');
            }

            Log::info('Checking payment status', ['post_type' => $post_type]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get(config('api.base_url') . "/payment/check/{$post_type}");

            Log::info('Payment check response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if (!$response->successful()) {
                Log::error('Payment check failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return redirect()->route('payment.initiate')->with('error', 'Failed to verify payment status.');
            }

            $data = $response->json();

            if (isset($data['status'], $data['data']['has_paid']) && 
                $data['status'] === 'success' && $data['data']['has_paid']) {
                Log::info('User has paid', [
                    'post_type' => $post_type,
                    'payment_id' => $data['data']['payment_id'] ?? null,
                ]);
                return view($postTypeViews[$post_type] ?? 'errors.404', [
                    'payment_id' => $data['data']['payment_id'],
                ]);
            }

            Log::warning('Payment not verified', ['post_type' => $post_type]);
            return redirect()->route('payment.initiate')->with('error', "Please complete payment to create a {$post_type} post.");
        } catch (\Exception $e) {
            Log::error('Error in createPost', [
                'post_type' => $post_type,
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('payment.initiate')->with('error', 'Failed to verify payment. Please try again.');
        }
    }



public function createPost(Request $request, $post_type)
{
    try {
        Log::info("Starting createPost for {$post_type}");

        // Map post types to view names
        $postTypeViews = [
            'birthday' => 'birthday.create',
            'caveat' => 'caveat.create',
            'change_of_name' => 'change-of-name.create',
            'dedication' => 'dedication.create',
            'lost_and_found' => 'lost-and-found.create',
            'missing_and_wanted' => 'missing-and-wanted.create',
            'obituary' => 'obituary.create',
            'public_notice' => 'public-notice.create',
            'remembrance' => 'remembrance.create',
            'stolen_vehicle' => 'stolen-vehicle.create',
            'wedding' => 'wedding.create',
        ];

        // Handle payment status from query parameters (callback redirect)
        $postId = $request->query('post_id');
        $postModel = $request->query('post_model');
        $paymentId = $request->query('payment_id');

        if ($request->query('status') === 'success' && $paymentId && $postId && $postModel) {
            Log::info('User redirected with successful payment', [
                'post_type' => $post_type,
                'payment_id' => $paymentId,
                'post_id' => $postId,
                'post_model' => $postModel,
            ]);
            return view($postTypeViews[$post_type] ?? 'errors.404', [
                'payment_id' => $paymentId,
                'post_id' => $postId,
                'post_model' => $postModel,
            ]);
        } elseif ($request->query('status') === 'failed') {
            Log::warning('Payment failed as per query parameter', [
                'post_type' => $post_type,
                'payment_id' => $paymentId,
            ]);
            return redirect()->route('payment.initiate')->with('error', 'Payment failed. Please try again.');
        }

        $token = session('api_token');
        if (!$token) {
            Log::warning('JWT token missing from session');
            return redirect()->route('login')->with('error', 'Authentication token missing.');
        }

        Log::info('Checking payment status', [
            'post_type' => $post_type,
            'post_id' => $postId,
            'post_model' => $postModel,
        ]);

        // Check payment status with post_id and post_model
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get(config('api.base_url') . "/payment/check/{$post_type}", [
            'post_id' => $postId,
            'post_model' => $postModel,
        ]);

        Log::info('Payment check response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if (!$response->successful()) {
            Log::error('Payment check failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return redirect()->route('payment.initiate')->with('error', 'Failed to verify payment status.');
        }

        $data = $response->json();

        if (isset($data['status'], $data['data']['has_paid']) && 
            $data['status'] === 'success' && $data['data']['has_paid']) {
            Log::info('User has paid', [
                'post_type' => $post_type,
                'payment_id' => $data['data']['payment_id'] ?? null,
                'post_id' => $data['data']['post_id'] ?? null,
                'post_model' => $data['data']['post_model'] ?? null,
            ]);
            return view($postTypeViews[$post_type] ?? 'errors.404', [
                'payment_id' => $data['data']['payment_id'],
                'post_id' => $data['data']['post_id'],
                'post_model' => $data['data']['post_model'],
            ]);
        }

        Log::warning('Payment not verified', [
            'post_type' => $post_type,
            'post_id' => $postId,
            'post_model' => $postModel,
        ]);
        return redirect()->route('payment.initiate')->with('error', "Please complete payment to create a {$post_type} post.");
    } catch (\Exception $e) {
        Log::error('Error in createPost', [
            'post_type' => $post_type,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return redirect()->route('payment.initiate')->with('error', 'Failed to verify payment. Please try again.');
    }
}

}
