<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MisplaceAndFoundController extends Controller
{
    public function createPost()
    {
        return view('misplace-and-found.create');
    }


    public function submitPost(Request $request)
    {
        Log::info('Found item submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validation rules (same as misplaced)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'phone_number' => 'required|string',
            'is_featured' => 'boolean',
            'is_draft' => 'boolean',
            'is_scheduled' => 'boolean',
            'scheduled_time' => 'nullable|date_format:Y-m-d\TH:i',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:155',
        ]);

        $jwtToken = session('api_token');

        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        $apiUrl = config('api.base_url') . '/submit/lost-and-found';
        Log::info('Connecting to API URL for found item creation', [
            'api_url' => $apiUrl,
        ]);

        $formData = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'phone_number' => $validated['phone_number'],
            'is_featured' => $validated['is_featured'] ?? false,
            'is_draft' => $validated['is_draft'] ?? false,
            'is_scheduled' => $validated['is_scheduled'] ?? false,
            'scheduled_time' => $validated['scheduled_time'] ?? null,
            'allow_comments' => $validated['allow_comments'] ?? true,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->attach(
                'featured_image',
                $request->hasFile('featured_image') ?
                    file_get_contents($request->file('featured_image')->getRealPath()) : null,
                $request->hasFile('featured_image') ?
                    $request->file('featured_image')->getClientOriginalName() : null
            )->post($apiUrl, $formData);

            if ($response->successful()) {
                Log::info('Found item successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Found item created successfully!');
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
            return back()->withErrors(['error' => 'An error occurred while submitting the found item.']);
        }
    }

    public function listLostAndFound()
    {
        // Log for debugging
        Log::info('Fetching published posts...');

        $apiUrl = config('api.base_url') . '/posts/lost-and-found';
        Log::info('API URL for published posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to the /published/posts endpoint to fetch the posts
            $response = Http::get($apiUrl, [
                'per_page' => 100,  // Get the first 100 posts
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                // Extract posts and pagination data from the response
                $responseData = $response->json();

                // Log the structure of the response for debugging
                Log::info('Response Data Structure:', [
                    'keys' => array_keys($responseData),
                    'data_keys' => isset($responseData['data']) ? array_keys($responseData['data']) : 'No data key'
                ]);

                // Extract posts data and pagination info
                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // Log the processed posts data
                Log::info('Processed Posts Data:', [
                    'posts_count' => count($postsData),
                    'pagination' => $pagination
                ]);

                // Optionally, return the posts and pagination to the frontend view
                return view('misplace-and-found.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination,
                ]);
            } else {
                // If the response failed, handle the error
                Log::error('Error fetching published posts: ' . $response->status());
                $postsData = [];
                $pagination = [];
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching published posts: ' . $e->getMessage());
            $postsData = [];
            $pagination = [];
        }

        // Return a default response when something goes wrong
        return view('misplace-and-found.lists', [
            'postsData' => $postsData,
            'pagination' => $pagination,
        ]);
    }



    public function showPostDetails(Request $request, $slug)
    {
        $apiUrl = config('api.base_url') . '/misplaced/' . $slug;

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();
                // Access the post data correctly from the nested structure
                $post = $data['data']['post'] ?? null;
            } else {
                $post = null;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching post details: ' . $e->getMessage());
            $post = null;
        }

        return view('misplace-and-found.show', compact('post'));
    }



    // end of the method signature
}
