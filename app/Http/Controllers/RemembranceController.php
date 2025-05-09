<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RemembranceController extends Controller
{
    public function createPost()
    {
        return view('remembrance.create');
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
            'age' => 'required|integer|min:0',
            'date_of_birth' => 'required|date',
            'year' => 'required|integer|min:0',
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
        $apiUrl = config('api.base_url') . '/submit/remembrance';
        Log::info('Connecting to API URL for remembrance person creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare formData based on validated data
        $formData = [
            'title' => $validated['title'], // Title of the obituary
            'slug' => $validated['slug'], // Slug for URL
            'content' => $validated['content'], // Content/Details of the obituary
            'age' => $validated['age'], // Age of the deceased
            'date_of_birth' => $validated['date_of_birth'], // Date of birth of the deceased
            'year' => $validated['year'], // Years of remembrance
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
                Log::info('Remembrance post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Remembrance post created successfully!');
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
            return back()->withErrors(['error' => 'An error occurred while submitting the Remembrance post.']);
        }
    }


    public function listPosts(Request $request)
    {
        Log::info('Fetching Remembrance posts...');

        $apiUrl = config('api.base_url') . '/posts/remembrance';
        Log::info('API URL for published posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to the /published/posts endpoint
            $response = Http::get($apiUrl, [
                'per_page' => 12,
                'page' => $request->get('page', 1), // Add current page
                'order' => 'desc',
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];
                $totalPublishedPosts = $pagination['total'] ?? 0;

                Log::info('Total Published Posts: ' . $totalPublishedPosts);

                //dd($responseData);
                return view('remembrance.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination,
                    'totalPublishedPosts' => $totalPublishedPosts,
                ]);
            } else {
                // If the response failed, handle the error
                Log::error('Error fetching published posts: ' . $response->status());
                return view('remembrance.lists', [
                    'postsData' => [],
                    'pagination' => [],
                    'totalPublishedPosts' => 0,
                ]);
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching published posts: ' . $e->getMessage());
            return view('remembrance.lists', [
                'postsData' => [],
                'pagination' => [],
                'totalPublishedPosts' => 0,
            ]);
        }
    }

    public function showRemembranceDetails(Request $request, $slug)
    {
        Log::info('Fetching Remembrance post details...', ['slug' => $slug]);

        // Define the API URL for fetching single post details
        $apiUrl = config('api.base_url') . '/posts/remembrance/' . $slug;


        try {
            // Make an API call to fetch post details by slug
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                // Extract the response body and check for the 'status' key
                $data = $response->json();
                $status = $data['status'] ?? null;

                // Check if the response status is 'success'
                if ($status === 'success') {
                    $post = $data['data'] ?? null;

                    // Check if post data is found
                    if (!$post) {
                        Log::warning('Post not found for slug: ' . $slug);
                        return response()->json(['message' => 'Post not found'], 404);
                    }

                    // print_r($post);
                    // exit();
                    // dd($posts);
                    // Return the view with the post data
                    return view('remembrance.show', compact('post'));
                } else {
                    // Handle the case where 'status' is not 'success'
                    Log::error('Failed to fetch post details from backend: ' . $data['message']);
                    return response()->json(['message' => 'Failed to fetch post details: ' . $data['message']], 500);
                }
            } else {
                // If the request itself fails (e.g., HTTP status is not 2xx)
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
