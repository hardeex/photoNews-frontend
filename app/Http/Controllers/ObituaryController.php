<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObituaryController extends Controller
{
    public function createPost()
    {
        return view('obituary.create');
    }


    public function submitPublicNotice(Request $request)
{
    Log::info('Public notice submission method is called...', [
        'request_data' => $request->all(),
    ]);

    // Validate the incoming form data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'content' => 'required',
        'featured_image' => 'nullable|image|max:2048',
        'gender' => 'required|in:male,female,other',
        'age' => 'required|integer|min:1',
        'height' => 'required|string|max:255',
        'skin_color' => 'required|in:light,medium,dark,other',
        'phone-number' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
        'is_featured' => 'boolean',
        'is_draft' => 'boolean',
        'is_scheduled' => 'boolean',
        'scheduled_time' => 'nullable|date_format:Y-m-d\TH:i',
        'allow_comments' => 'nullable|boolean',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:155',
        'review_feedback' => 'nullable|string',
    ]);

    // Get the JWT token from session (after login)
    $jwtToken = session('api_token');

    // If the JWT token is missing or expired, redirect to the login page
    if (empty($jwtToken)) {
        Log::warning('JWT token missing or expired');
        return redirect()->route('user.login')->with('error', 'Please log in first');
    }

    // API URL for post submission
    $apiUrl = config('api.base_url') . '/submit/public-notice';
    Log::info('Connecting to API URL for post creation', [
        'api_url' => $apiUrl,
    ]);

    // Prepare the form data
    $formData = [
        'title' => $validated['title'],
        'slug' => $validated['slug'],
        'content' => $validated['content'],
        'gender' => $validated['gender'],
        'age' => $validated['age'],
        'height' => $validated['height'],
        'skin_color' => $validated['skin_color'],
        'phone_number' => $validated['phone-number'],
        'is_featured' => $validated['is_featured'] ?? false,
        'is_draft' => $validated['is_draft'] ?? false,
        'is_scheduled' => $validated['is_scheduled'] ?? false,
        'scheduled_time' => $validated['scheduled_time'] ?? null,
        'allow_comments' => $validated['allow_comments'] ?? true,
        'meta_title' => $validated['meta_title'] ?? null,
        'meta_description' => $validated['meta_description'] ?? null,
        'review_feedback' => $validated['review_feedback'] ?? null,
    ];

    // Prepare file upload if image exists
    try {
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

        // Log the response from the external API
        if ($response->successful()) {
            Log::info('Public notice successfully created through external API', [
                'response_data' => $response->json(),
            ]);

            return redirect()->back()->with('success', 'Post created successfully!');
        } else {
            // Handle API errors
            Log::error('Error returned from external API', [
                'status_code' => $response->status(),
                'error_message' => $response->json()['message'] ?? 'An error occurred.',
            ]);
            return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
        }
    } catch (\Exception $e) {
        // Log any exceptions during the API call
        Log::error('API request failed', [
            'exception_message' => $e->getMessage(),
            'exception_trace' => $e->getTraceAsString(),
        ]);
        return back()->withErrors(['error' => 'An error occurred while submitting the post.']);
    }
}

}
