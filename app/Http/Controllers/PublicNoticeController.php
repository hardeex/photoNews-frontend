<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class PublicNoticeController extends Controller
{
    public function createPost()
    {
        return view('public-notice.create');
    }

    public function submitPost(Request $request)
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
                Log::info('Post successfully created through external API', [
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

    public function listPublicLists(Request $request)
    {
        Log::info('Fetching Public Notices...');

        $apiUrl = config('api.base_url') . '/public-notice';
        Log::info('API URL for public notices:', ['url' => $apiUrl]);

        try {
            $response = Http::get($apiUrl, [
                'per_page' => 12,
                'page' => $request->get('page', 1),
                'order' => 'desc',
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                // The posts data is directly in the 'posts' object
                $postsData = $responseData['posts']['data'] ?? [];

                // Get pagination data directly from the 'posts' object
                $pagination = array_merge(
                    Arr::except($responseData['posts'], ['data']),
                    ['total' => $responseData['posts']['total'] ?? 0]
                );

                return view('public-notice.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination
                ]);
            } else {
                Log::error('Error fetching public notices:', ['status' => $response->status()]);
                return view('public-notice.lists', [
                    'postsData' => [],
                    'pagination' => ['total' => 0, 'per_page' => 12]
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching public notices:', ['message' => $e->getMessage()]);
            return view('public-notice.lists', [
                'postsData' => [],
                'pagination' => ['total' => 0, 'per_page' => 12]
            ]);
        }
    }






    public function showPublicNoticeDetails(Request $request, $slug)
    {
        Log::info('Fetching Public notice post details...', ['slug' => $slug]);

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
