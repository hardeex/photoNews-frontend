<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Cloudinary\Cloudinary;

class CaveatController extends Controller
{
    public function createPost()
    {
        return view('caveat.create');
    }


    public function submitPost(Request $request)
    {
        Log::info('Caveat Posts submission method is called...', [
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


        // print_r($formData);
        // exit();

        Log::info('Request Payload:', $validated);  // Before sending to the API

        // API URL for post submission
        $apiUrl = config('api.base_url') . '/submit/caveat';
        Log::info('Connecting to API URL for caveat post creation', [
            'api_url' => $apiUrl,
        ]);

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
                Log::info('Caveat Post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Caveat Post created successfully!');
            } else {
                // Handle API errors
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred creatingn caveat post.',
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


    public function showCaveatDetails(Request $request, $slug)
    {
        $apiUrl = config('api.base_url') . '/caveat/' . $slug;

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $responseData = $response->json();
                // Access the post data correctly from the nested structure
                $post = $responseData['data']['post'] ?? null;
            } else {
                $post = null;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching post details: ' . $e->getMessage());
            $post = null;
        }

        return view('caveat.show', compact('post'));
    }



    // public function listCaveatPosts()
    // {
    //     // Log for debugging
    //     Log::info('Fetching Caveat approved posts...');

    //     $apiUrl = config('api.base_url') . '/posts/caveat';
    //     Log::info('API URL for approved Caveat posts:', ['url' => $apiUrl]);

    //     try {
    //         // Make an API call to fetch the approved posts with 'caveat' = true
    //         $response = Http::get($apiUrl, [
    //             'per_page' => 10,
    //             //'event' => true,
    //         ]);

    //         // Check if the response was successful
    //         if ($response->successful()) {
    //             $responseData = $response->json();

    //             // Extract posts data and pagination info
    //             $caveatPostsData = $responseData['data']['posts'] ?? [];
    //             $pagination = $responseData['data']['pagination'] ?? [];

    //             $totalCaveatPosts = $pagination['total'] ?? 0;
    //             Log::info('The total caveat posts:' . $totalCaveatPosts);

    //             print_r($caveatPostsData);
    //             exit();

    //             //Return the data
    //             //return $caveatPostsData;
    //             return view('caveat.list', compact('caveatPostsData', 'totalCaveatPosts'));
    //         } else {
    //             Log::error('Error fetching approved Events posts: ' . $response->status());
    //             return [];
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching approved Events posts: ' . $e->getMessage());
    //         return [];
    //     }
    // }


    public function listCaveatPosts2()
    {
        // Log for debugging
        Log::info('Fetching Caveat approved posts...');

        $apiUrl = config('api.base_url') . '/posts/caveat';
        Log::info('API URL for approved Caveat posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'caveat' = true
            $response = Http::get($apiUrl, [
                'per_page' => 10,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data and pagination info
                $caveatPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                $totalCaveatPosts = $pagination['total'] ?? 0;
                Log::info('The total caveat posts:' . $totalCaveatPosts);

                return view('caveat.list', compact('caveatPostsData', 'totalCaveatPosts'));
            } else {
                Log::error('Error fetching approved Caveat posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved Caveat posts: ' . $e->getMessage());
            return [];
        }
    }

    public function listCaveatPosts()
    {
        // Log for debugging
        Log::info('Fetching Caveat approved posts...');

        // Define both API URLs
        $apiBaseUrl = config('api.base_url');
        $caveatUrl = $apiBaseUrl . '/posts/caveat';
        $articleUrl = $apiBaseUrl . '/posts/caveat/article';

        // Log the API URLs
        Log::info('API URL for Caveat posts:', ['url' => $caveatUrl]);
        Log::info('API URL for Caveat article posts:', ['url' => $articleUrl]);

        try {
            // Fetch Caveat posts from /posts/caveat
            $responseCaveat = Http::get($caveatUrl, [
                'per_page' => 10,
            ]);

            // Fetch Caveat articles from /posts/caveat/article
            $responseArticle = Http::get($articleUrl, [
                'per_page' => 10,
            ]);

            // Check if both responses are successful
            $caveatPostsData = [];
            $articlePostsData = [];
            $totalCaveatPosts = 0;
            $totalArticlePosts = 0;

            if ($responseCaveat->successful()) {
                $responseDataCaveat = $responseCaveat->json();
                $caveatPostsData = $responseDataCaveat['data']['posts'] ?? [];
                $paginationCaveat = $responseDataCaveat['data']['pagination'] ?? [];
                $totalCaveatPosts = $paginationCaveat['total'] ?? 0;
                Log::info('The total Caveat posts: ' . $totalCaveatPosts);
            } else {
                Log::error('Error fetching Caveat posts: ' . $responseCaveat->status());
            }

            if ($responseArticle->successful()) {
                $responseDataArticle = $responseArticle->json();
                $articlePostsData = $responseDataArticle['data']['posts'] ?? [];
                $paginationArticle = $responseDataArticle['data']['pagination'] ?? [];
                $totalArticlePosts = $paginationArticle['total'] ?? 0;
                Log::info('The total Article posts: ' . $totalArticlePosts);
            } else {
                Log::error('Error fetching Article posts: ' . $responseArticle->status());
            }

            // Return the combined view with data from both API calls
            return view('caveat.list', [
                'caveatPostsData' => $caveatPostsData,
                'totalCaveatPosts' => $totalCaveatPosts,
                'articlePostsData' => $articlePostsData,
                'totalArticlePosts' => $totalArticlePosts,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching Caveat posts: ' . $e->getMessage());
            return [];
        }
    }
}
