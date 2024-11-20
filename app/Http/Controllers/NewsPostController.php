<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NewsPostController extends Controller
{

    // public function createPost()
    // {

    //     $jwtToken = session('api_token');
    //     if (empty($jwtToken)) {
    //         return redirect()->route('user.login')->with('error', 'Please log in first');
    //     }

    //     // Original endpoint to get categories for creation (keep existing variable name)
    //     $apiUrl = config('api.base_url') . '/get-categories';
    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $jwtToken,
    //         ])->get($apiUrl);

    //         if ($response->successful()) {
    //             $categories = $response->json()['data'] ?? [];  // Use 'categories' as before
    //             Log::info('Fetched categories for creation: ' . json_encode($categories));
    //         } else {
    //             $categories = [];
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching categories for creation: ' . $e->getMessage());
    //         $categories = [];
    //     }

    //     $jwtToken = session('api_token');
    //     if (empty($jwtToken)) {
    //         return redirect()->route('user.login')->with('error', 'Please log in first');
    //     }

    //     // Original endpoint to get tags for creation
    //     $apiUrl = config('api.base_url') . '/get-tags'; // Adjust the endpoint if necessary
    //     Log::info('Attempting to fetch tags for creation', [
    //         'api_url' => $apiUrl,
    //     ]);

    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $jwtToken,
    //         ])->get($apiUrl);

    //         // Log the response from the API
    //         Log::info('API response for fetching tags', [
    //             'status_code' => $response->status(),
    //             'response_body' => $response->body(),
    //         ]);

    //         if ($response->successful()) {
    //             $tags = $response->json()['data'] ?? [];  // Use 'tags' as before
    //             Log::info('Fetched tags for creation: ' . json_encode($tags));
    //         } else {
    //             $tags = [];
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching tags for creation: ' . $e->getMessage());
    //         $tags = [];
    //     }


    //     return view('news.create-post', compact('categories', 'tags'));
    // }


    public function createPost()
    {
        $jwtToken = session('api_token');
        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Fetch categories and tags
        $categories = $this->fetchData('get-categories', $jwtToken);
        $tags = $this->fetchData('get-tags', $jwtToken);

        return view('news.create-post', compact('categories', 'tags'));
    }

    private function fetchData($endpoint, $jwtToken)
    {
        $apiUrl = config('api.base_url') . '/' . $endpoint;
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($apiUrl);

            // Log the response from the API
            Log::info('API response for fetching ' . $endpoint, [
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            if ($response->successful()) {
                return $response->json()['data'] ?? [];
            } else {
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching ' . $endpoint . ': ' . $e->getMessage());
            return [];
        }
    }


    public function newsCategoryList()
    {
        return view('news.show');
    }

    public function newDetails()
    {
        return view('news.details');
    }


    // categories method
    public function createCategory()
    {
        $jwtToken = session('api_token');
        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Original endpoint to get categories for creation (keep existing variable name)
        $apiUrl = config('api.base_url') . '/get-categories';
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($apiUrl);

            if ($response->successful()) {
                $categories = $response->json()['data'] ?? [];  // Use 'categories' as before
                Log::info('Fetched categories for creation: ' . json_encode($categories));
            } else {
                $categories = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching categories for creation: ' . $e->getMessage());
            $categories = [];
        }

        // New endpoint to list categories for display (new variable name)
        $listCategoriesUrl = config('api.base_url') . '/list-categories'; // the one with pagination
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($listCategoriesUrl);

            if ($response->successful()) {
                $categoriesForDisplay = $response->json()['data'] ?? [];
                Log::info('Fetched categories for display: ' . json_encode($categoriesForDisplay));
                // dd($categoriesForDisplay);
            } else {
                $categoriesForDisplay = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching categories for display: ' . $e->getMessage());
            $categoriesForDisplay = [];
        }



        return view('news.category', compact('categories', 'categoriesForDisplay'));
    }





    public function submitCategory(Request $request)
    {
        Log::info('Submit category to the endpoint method is called...', [
            'request_data' => $request->all(),  // Log all incoming request data
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
        ]);

        // Log the validated data before proceeding
        Log::info('Validated category data', [
            'category_name' => $validated['category_name'],
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'],
        ]);

        // Get the JWT token from session (after login)
        $jwtToken = session('api_token');

        // If the JWT token is missing or expired, redirect to the login page
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for category submission
        $apiUrl = config('api.base_url') . '/create-category';
        Log::info('Connecting to API URL for category creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare the data to be sent to the API
        $data = [
            'category_name' => $validated['category_name'],
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'],
        ];

        // Log the data that is about to be sent to the external API
        Log::info('Sending data to external API', [
            'data' => $data,
        ]);

        // Make the POST request to the external API
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post($apiUrl, $data);


            // Log the response from the external API
            if ($response->successful()) {
                Log::info('Category successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                // Handle successful response
                return redirect()->back()->with('success', 'Category created successfully!');
            } else {
                // If the token has expired or is invalid, we need to catch that
                if ($response->status() === 401) {
                    Log::warning('Expired or invalid token detected');
                    return redirect()->route('user.login')->with('error', 'Session expired. Please log in again.');
                }

                // Log the error response from the API
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred.',
                ]);
                return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
            }
        } catch (\Exception $e) {
            // Log the exception error with stack trace
            Log::error('API request failed with exception', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => 'An error occurred while submitting the category.']);
        }
    }


    // tags methods

    public function createTag()
    {
        $jwtToken = session('api_token');
        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Original endpoint to get tags for creation
        $apiUrl = config('api.base_url') . '/get-tags'; // Adjust the endpoint if necessary
        Log::info('Attempting to fetch tags for creation', [
            'api_url' => $apiUrl,
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($apiUrl);

            // Log the response from the API
            Log::info('API response for fetching tags', [
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            if ($response->successful()) {
                $tags = $response->json()['data'] ?? [];  // Use 'tags' as before
                Log::info('Fetched tags for creation: ' . json_encode($tags));
            } else {
                $tags = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching tags for creation: ' . $e->getMessage());
            $tags = [];
        }

        // New endpoint to list tags for display
        $listTagsUrl = config('api.base_url') . '/list-tags'; // Adjust the endpoint if necessary
        Log::info('Attempting to fetch tags for display', [
            'api_url' => $listTagsUrl,
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($listTagsUrl);

            // Log the response from the API
            Log::info('API response for fetching tags for display', [
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            if ($response->successful()) {
                $tagsForDisplay = $response->json()['data'] ?? [];
                Log::info('Fetched tags for display: ' . json_encode($tagsForDisplay));
            } else {
                $tagsForDisplay = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching tags for display: ' . $e->getMessage());
            $tagsForDisplay = [];
        }

        // Return the view with the fetched data for tags and tagsForDisplay
        return view('news.tag', compact('tags', 'tagsForDisplay'));
    }



    public function submitTag(Request $request)
    {
        Log::info('Submit tag to the endpoint method is called...', [
            'request_data' => $request->all(),  // Log all incoming request data
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'tag_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
        ]);

        // Log the validated data before proceeding
        Log::info('Validated tag data', [
            'tag_name' => $validated['tag_name'],
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'],
        ]);

        // Get the JWT token from session (after login)
        $jwtToken = session('api_token');

        // If the JWT token is missing or expired, redirect to the login page
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for tag submission
        $apiUrl = config('api.base_url') . '/create-tag';
        Log::info('Connecting to API URL for tag creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare the data to be sent to the API
        $data = [
            'tag_name' => $validated['tag_name'],
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'],
        ];

        // Log the data that is about to be sent to the external API
        Log::info('Sending data to external API', [
            'data' => $data,
        ]);

        // Make the POST request to the external API
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post($apiUrl, $data);

            // Log the response from the external API
            if ($response->successful()) {
                Log::info('Tag successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                // Handle successful response
                return redirect()->back()->with('success', 'Tag created successfully!');
            } else {
                // If the token has expired or is invalid, we need to catch that
                if ($response->status() === 401) {
                    Log::warning('Expired or invalid token detected');
                    return redirect()->route('user.login')->with('error', 'Session expired. Please log in again.');
                }

                // Log the error response from the API
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred.',
                ]);
                return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
            }
        } catch (\Exception $e) {
            // Log the exception error with stack trace
            Log::error('API request failed with exception', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => 'An error occurred while submitting the tag.']);
        }
    }



    // news method

    public function submitPost33(Request $request)
    {
        Log::info('Submit post to the endpoint method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news_posts,slug',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_breaking' => 'boolean',
            'hot_gist' => 'boolean',
            'event' => 'boolean',
            'top_topic' => 'boolean',
            'is_draft' => 'boolean',
            'is_scheduled' => 'boolean',
            'scheduled_time' => 'nullable|date_format:Y-m-d\TH:i',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:155',
        ]);

        // Log the validated data
        Log::info('Validated post data', $validated);

        // Get the JWT token from session
        $jwtToken = session('api_token');

        // Check JWT token
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for post submission
        $apiUrl = config('api.base_url') . '/submit-post';
        Log::info('Connecting to API URL for post creation', ['api_url' => $apiUrl]);

        // Prepare the data to be sent to the API
        $data = $validated;

        // Handle file upload for featured image
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = base64_encode(file_get_contents($request->file('featured_image')));
        }

        // Log the data that is about to be sent to the external API
        Log::info('Sending data to external API', ['data' => array_merge($data, ['featured_image' => $data['featured_image'] ? '[BASE64 ENCODED IMAGE]' : 'No image'])]);

        // Make the POST request to the external API
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post($apiUrl, $data);

            // Log the response from the external API
            if ($response->successful()) {
                Log::info('Post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                // Handle successful response
                return redirect()->route('posts.index')->with('success', 'Post created successfully!');
            } else {
                // If the token has expired or is invalid
                if ($response->status() === 401) {
                    Log::warning('Expired or invalid token detected');
                    return redirect()->route('user.login')->with('error', 'Session expired. Please log in again.');
                }

                // Log the error response from the API
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred.',
                ]);

                return back()->withInput()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
            }
        } catch (\Exception $e) {
            // Log the exception error with stack trace
            Log::error('API request failed with exception', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->withErrors(['error' => 'An error occurred while submitting the post.']);
        }
    }


    public function submitPost(Request $request)
    {
        Log::info('Post submission method is called...', [
            'request_data' => $request->all(), // Log all incoming request data
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255 ',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'nullable',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable',
            'is_featured' => 'boolean',
            'is_breaking' => 'boolean',
            'hot_gist' => 'boolean',
            'event' => 'boolean',
            'top_topic' => 'boolean',
            'is_draft' => 'boolean',
            'is_scheduled' => 'boolean',
            'scheduled_time' => 'nullable|date_format:Y-m-d\TH:i',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:155',
            'review_feedback' => 'nullable|string',
        ]);

        // Log the validated data before proceeding
        Log::info('Validated post data', [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            //'is_featured' => $validated['is_featured'],
            // Include other relevant fields
        ]);

        // Get the JWT token from session (after login)
        $jwtToken = session('api_token');

        // If the JWT token is missing or expired, redirect to the login page
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for post submission
        $apiUrl = config('api.base_url') . '/submit-post';
        Log::info('Connecting to API URL for post creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare the data to be sent to the API
        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'categories' => $validated['categories'],
            'tags' => $validated['tags'] ?? [],
            'is_featured' => $validated['is_featured'] ?? false,
            'is_breaking' => $validated['is_breaking'] ?? false,
            'hot_gist' => $validated['hot_gist'] ?? false,
            'event' => $validated['event'] ?? false,
            'top_topic' => $validated['top_topic'] ?? false,
            'is_draft' => $validated['is_draft'] ?? false,
            'is_scheduled' => $validated['is_scheduled'] ?? false,
            'scheduled_time' => $validated['scheduled_time'] ?? null,
            'allow_comments' => $validated['allow_comments'] ?? true,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'review_feedback' => $validated['review_feedback'] ?? null,
        ];

        // Log the data that is about to be sent to the external API
        Log::info('Sending data to external API', [
            'data' => $data,
        ]);

        // Make the POST request to the external API
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post($apiUrl, $data);

            // Log the response from the external API
            if ($response->successful()) {
                Log::info('Post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                // Handle successful response
                return redirect()->back()->with('success', 'Post created successfully!');
            } else {
                // If the token has expired or is invalid, we need to catch that
                if ($response->status() === 401) {
                    Log::warning('Expired or invalid token detected');
                    return redirect()->route('user.login')->with('error', 'Session expired. Please log in again.');
                }

                // Log the error response from the API
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred.',
                ]);
                return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
            }
        } catch (\Exception $e) {
            // Log the exception error with stack trace
            Log::error('API request failed with exception', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => 'An error occurred while submitting the post.']);
        }
    }


    // End of the class
}
