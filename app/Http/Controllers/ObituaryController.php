<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class ObituaryController extends Controller
{
    public function createPost()
    {
        return view('obituary.create');
    }


    public function submitPost(Request $request)
    {
        Log::info('Obituary submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:0',
            'date_of_birth' => 'required|date',
            'is_featured' => 'nullable|boolean',
            'is_draft' => 'nullable|boolean',
            'is_scheduled' => 'nullable|boolean',
            'scheduled_time' => 'nullable|date|after:now',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:155',
            'meta_description' => 'nullable|string|max:155',
        ]);

        // Get the JWT token from the session
        $jwtToken = session('api_token');

        // Redirect to login if the JWT token is missing
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for submission
        $apiUrl = config('api.base_url') . '/submit/obituary';
        Log::info('Connecting to API URL for obituary creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare form data
        $formData = [
            'title' => $validated['title'], // Title of the obituary
            'slug' => $validated['slug'], // Slug for URL
            'content' => $validated['content'], // Content/Details of the obituary
            'gender' => $validated['gender'], // Gender (male, female, or other)
            'age' => $validated['age'], // Age of the deceased
            'date_of_birth' => $validated['date_of_birth'], // Date of birth of the deceased
            'is_featured' => $validated['is_featured'] ?? false, // Whether the obituary is featured
            'is_draft' => $validated['is_draft'] ?? false, // Whether the obituary is saved as a draft
            'is_scheduled' => $validated['is_scheduled'] ?? false, // Whether the obituary is scheduled for future publication
            'scheduled_time' => $validated['scheduled_time'] ?? null, // Scheduled date & time for the obituary
            'allow_comments' => $validated['allow_comments'] ?? true, // Whether to allow comments on the obituary
            'meta_title' => $validated['meta_title'] ?? null, // Meta title for SEO
            'meta_description' => $validated['meta_description'] ?? null, // Meta description for SEO
            'featured_image' => $validated['featured_image'] ?? null, // Featured image (optional, might be uploaded)
            'review_feedback' => $validated['review_feedback'] ?? null, // Review feedback (only for admins)
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
                Log::info('Obituary post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Obituary post created successfully!');
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
            return back()->withErrors(['error' => 'An error occurred while submitting the Obituary post.']);
        }
    }


    public function listObituaryPosts(Request $request)
    {
        Log::info('Fetching Obituaries...');

        // Set up the API URL
        $apiUrl = config('api.base_url') . '/posts/obituary';
        Log::info('API URL for obituaries:', ['url' => $apiUrl]);

        try {
            // Call the API to fetch obituary posts
            $response = Http::get($apiUrl, [
                'per_page' => 12,
                'page' => $request->get('page', 1),
                'order' => 'desc',
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract the posts data
                $postsData = $responseData['data']['posts'] ?? [];

                // Extract pagination data
                $pagination = [
                    'total' => $responseData['data']['pagination']['total'] ?? 0,
                    'current_page' => $responseData['data']['pagination']['current_page'] ?? 1,
                    'per_page' => $responseData['data']['pagination']['per_page'] ?? 12,
                    'last_page' => $responseData['data']['pagination']['last_page'] ?? 1,
                    'next_page_url' => $responseData['data']['pagination']['next_page_url'] ?? null,
                    'prev_page_url' => $responseData['data']['pagination']['prev_page_url'] ?? null,
                ];

                // Dump postsData for debugging
                //dd($postsData);  

                // Pass data to view
                return view('obituary.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination,
                ]);
            } else {
                // Log the error if API call fails
                Log::error('Error fetching obituary posts:', ['status' => $response->status()]);
                return view('obituary.lists', [
                    'postsData' => [],
                    'pagination' => ['total' => 0, 'per_page' => 12],
                ]);
            }
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Error fetching obituary posts:', ['message' => $e->getMessage()]);
            return view('obituary.lists', [
                'postsData' => [],
                'pagination' => ['total' => 0, 'per_page' => 12],
            ]);
        }
    }

    public function showObituaryDetails(Request $request, $slug)
    { Log::info('Fetching Public notice post details...', ['slug' => $slug]);

        // Define the API URL for fetching single post details
        $apiUrl = config('api.base_url') . '/posts/public-notice/' . $slug;

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
                    $post = $data['post'] ?? null;

                    // If no post data, return a warning message
                    if (!$post) {
                        Log::warning('Post not found for slug: ' . $slug);
                        return response()->json(['message' => 'Post not found'], 404);
                    }

                    //dd($data);

                    // Return the view with the post data
                    return view('public-notice.show', compact('post'));
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
