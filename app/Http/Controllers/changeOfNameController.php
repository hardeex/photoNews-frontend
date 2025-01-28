<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class changeOfNameController extends Controller
{
    public function createPost()
    {
        return view('change-of-name.create');
    }

    public function submitPost(Request $request)
    {
        Log::info('Change of Name submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'old_name' => 'required|string|max:255',
            'new_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'is_draft' => 'nullable|boolean',
            'is_scheduled' => 'nullable|boolean',
            'scheduled_time' => 'nullable|date|after:now',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:155',
            'meta_description' => 'nullable|string|max:155',
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
        $apiUrl = config('api.base_url') . '/submit/change-of-name';
        Log::info('Connecting to API URL for change of namecreation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare formData based on validated data
        $formData = [
            'old_name' => $validated['old_name'], // Initial Name (required)
            'new_name' => $validated['new_name'], // New Name (required)
            'slug' => $validated['slug'], // Slug for URL (required)
            'content' => $validated['content'], // Content/Details of the change of name (required)
            'is_featured' => $validated['is_featured'] ?? false, // Whether the post is featured (optional, defaults to false)
            'is_draft' => $validated['is_draft'] ?? false, // Whether the post is saved as a draft (optional, defaults to false)
            'is_scheduled' => $validated['is_scheduled'] ?? false, // Whether the post is scheduled for future publication (optional, defaults to false)
            'scheduled_time' => $validated['scheduled_time'] ?? null, // Scheduled date & time for the post (optional, nullable)
            'allow_comments' => $validated['allow_comments'] ?? true, // Whether to allow comments on the post (optional, defaults to true)
            'meta_title' => $validated['meta_title'] ?? null, // Meta title for SEO (optional)
            'meta_description' => $validated['meta_description'] ?? null, // Meta description for SEO (optional)
            'review_feedback' => $validated['review_feedback'] ?? null, // Review feedback (optional, only for admins)

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
                Log::info('Change of name successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Change of name post created successfully!');
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
            return back()->withErrors(['error' => 'An error occurred while submitting the change of name.']);
        }
    }


    public function listPosts(Request $request)
    {
        Log::info('Fetching Missing and Wanted posts...');

        // Set the API URL (adjust as per your config)
        $apiUrl = config('api.base_url') . '/posts/change-of-name';
        Log::info('API URL for fetching posts:', ['url' => $apiUrl]);

        try {
            // Make the API request with parameters for pagination
            $response = Http::get($apiUrl, [
                'per_page' => 12,
                'page' => $request->get('page', 1),
                'order' => 'desc',
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                // Ensure posts are properly extracted from the API response
                $postsData = $responseData['data']['posts'] ?? [];

                // Extract pagination details from the API response
                $pagination = $responseData['data']['pagination'] ?? [
                    'total' => 0,
                    'current_page' => 1,
                    'per_page' => 12,
                    'last_page' => 1,
                    'next_page_url' => null,
                    'prev_page_url' => null,
                ];

                // Dump the response for debugging (can be removed later)
                //dd($responseData);

                // Pass posts data and pagination to the view
                return view('change-of-name.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination
                ]);
            } else {
                // Handle unsuccessful response from API
                Log::error('Error fetching Missing and Wanted posts:', ['status' => $response->status()]);
                return view('change-of-name.lists', [
                    'postsData' => [],
                    'pagination' => [
                        'total' => 0,
                        'per_page' => 12,
                        'current_page' => 1,
                        'last_page' => 1,
                    ]
                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., network issues)
            Log::error('Error fetching Missing and Wanted posts:', ['message' => $e->getMessage()]);
            return view('change-of-name.lists', [
                'postsData' => [],
                'pagination' => [
                    'total' => 0,
                    'per_page' => 12,
                    'current_page' => 1,
                    'last_page' => 1,
                ]
            ]);
        }
    }


    public function showChangeOfNameDetails(Request $request, $slug)
    {
        Log::info('Fetching Change of Name post details...', ['slug' => $slug]);
    
        // Define the API URL for fetching single post details
        $apiUrl = config('api.base_url') . '/posts/change-of-name/' . $slug;
    
        try {
            // Make an API call to fetch post details by slug
            $response = Http::get($apiUrl);
    
            // Check if the request was successful (HTTP status 2xx)
            if ($response->successful()) {
                // Extract the response body as an array
                $data = $response->json();
    
                // Check if the 'status' key exists in the response
                if (isset($data['status']) && $data['status'] === 'success') {
                    // The post data is available
                    $post = $data['data']['post'] ?? null;
    
                    // If no post data, return a warning message
                    if (!$post) {
                        Log::warning('Post not found for slug: ' . $slug);
                        return response()->json(['message' => 'Post not found'], 404);
                    }
    
                    // Return the view with the post data
                    return view('change-of-name.show', compact('post'));
                } else {
                    // If the status is not 'success', log the message and return an error
                    Log::error('Failed to fetch post details from backend: ' . $data['message']);
                    return response()->json(['message' => 'Failed to fetch post details: ' . $data['message']], 500);
                }
            } else {
                // If the HTTP request fails (non-2xx status), log the error
                Log::error('Failed to fetch post details from backend service', ['slug' => $slug, 'status' => $response->status()]);
                return response()->json(['message' => 'Failed to fetch post details'], 500);
            }
        } catch (\Exception $e) {
            // Log the exception error and return fallback response
            Log::error('Error fetching post details from backend service: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching post details'], 500);
        }
    }
    
}
