<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MissingPersonController extends Controller
{
    public function createPost()
    {
        return view('missing.create');
    }

    public function submitPost(Request $request)
    {
        Log::info('Missing person submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'gender' => 'required|in:male,female,other',
            'option' => 'required|in:missing,wanted',
            'age' => 'required|integer|min:0',
            'height' => 'required|string|max:100',
            'skin_color' => 'required|in:light,medium,dark,other',
            'phone_number' => 'required|string',
            'last_seen' => 'nullable|string|max:255',
            'clothing_description' => 'nullable|string|max:500',
            'date_missing' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:155',
            'is_featured' => 'nullable|boolean',
            'is_draft' => 'nullable|boolean',
            'is_scheduled' => 'nullable|boolean',
            'scheduled_time' => 'nullable|date_format:Y-m-d\TH:i', // ISO 8601 format
            'allow_comments' => 'nullable|boolean',
            'review_feedback' => 'nullable|string',
        ]);

        // Get the JWT token from the session
        $jwtToken = session('api_token');

        // Redirect to login if the JWT token is missing
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for submission
        $apiUrl = config('api.base_url') . '/submit/missing-and-wanted';
        Log::info('Connecting to API URL for missing person creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare form data
        $formData = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'gender' => $validated['gender'],
            'option' => $validated['option'],
            'age' => $validated['age'],
            'height' => $validated['height'],
            'skin_color' => $validated['skin_color'],
            'phone_number' => $validated['phone_number'], // Fixed field name
            'last_seen' => $validated['last_seen'] ?? null,
            'clothing_description' => $validated['clothing_description'] ?? null,
            'date_missing' => $validated['date_missing'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_draft' => $validated['is_draft'] ?? false,
            'is_scheduled' => $validated['is_scheduled'] ?? false,
            'scheduled_time' => $validated['scheduled_time'] ?? null,
            'allow_comments' => $validated['allow_comments'] ?? true,
            'review_feedback' => $validated['review_feedback'] ?? null,
        ];

        try {
            // API call with the form data and the image file if provided
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->attach(
                'featured_image',
                $request->hasFile('featured_image') ?
                    file_get_contents($request->file('featured_image')->getRealPath()) :
                    null,
                $request->hasFile('featured_image') ?
                    $request->file('featured_image')->getClientOriginalName() :
                    null
            )->post($apiUrl, $formData);

            // Log the response and handle the outcome
            if ($response->successful()) {
                Log::info('Missing &amp; Wanted person post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Missing person post created successfully!');
            } else {
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred.',
                ]);
                return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
            }
        } catch (\Exception $e) {
            Log::error('API request failed', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => 'An error occurred while submitting the missing person post.']);
        }
    }
}
