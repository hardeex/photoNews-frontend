<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Cloudinary\Cloudinary;

class NewsPostController extends Controller
{

    protected $cloudinary;

    public function __construct()
    {
        // Configure Cloudinary
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

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


    // public function listCategoriesFromAPI(Request $request)
    // {
    //     Log::info('Fetching categories from external API...');

    //     // API URL for category listing
    //     $apiUrl = config('api.base_url') . '/categories/public';
    //     Log::info('Connecting to API URL for category listing', [
    //         'api_url' => $apiUrl,
    //     ]);

    //     // Optional: Prepare any query parameters (e.g., for sorting)
    //     $params = [
    //         'sort_by' => $request->get('sort_by', 'name'),
    //         'sort_order' => $request->get('sort_order', 'asc'),
    //     ];

    //     // Log the query parameters being sent
    //     Log::info('Sending query parameters', [
    //         'params' => $params,
    //     ]);

    //     // Make the GET request to the external API
    //     try {
    //         $response = Http::get($apiUrl, $params);

    //         // Log the response from the external API
    //         if ($response->successful()) {
    //             Log::info('Categories successfully fetched from external API', [
    //                 'response_data' => $response->json(),
    //             ]);

    //             // Handle successful response
    //             $categories = $response->json()['data'];  // Extract categories from response

    //             // print_r($categories);
    //             // exit();

    //             // Return the categories to the view or frontend
    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => 'Categories fetched successfully!',
    //                 'data' => $categories,
    //             ], 200);
    //         } else {
    //             // Log the error response from the API
    //             Log::error('Error fetching categories from external API', [
    //                 'status_code' => $response->status(),
    //                 'error_message' => $response->json()['message'] ?? 'An error occurred.',
    //             ]);

    //             return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
    //         }
    //     } catch (\Exception $e) {
    //         // Log the exception error with stack trace
    //         Log::error('API request failed with exception', [
    //             'exception_message' => $e->getMessage(),
    //             'exception_trace' => $e->getTraceAsString(),
    //         ]);

    //         return back()->withErrors(['error' => 'An error occurred while fetching categories.']);
    //     }
    // }

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
            ])->attach(
                'featured_image',
                $request->hasFile('featured_image') ?
                    file_get_contents($request->file('featured_image')->getRealPath()) :
                    null,
                $request->hasFile('featured_image') ?
                    $request->file('featured_image')->getClientOriginalName() :
                    null
            )->post($apiUrl, $data);

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


    public function showPostDetails(Request $request, $slug)
    {
        $apiUrl = config('api.base_url') . '/post/' . $slug;  // API endpoint for single post

        try {
            // Make the API call to fetch post details by slug
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                // Get post data from the API response
                $data = $response->json();
                $post = $data['data'] ?? null;  // The 'post' data from the API response
            } else {
                $post = null;
            }
        } catch (\Exception $e) {
            // Log error and handle failure
            Log::error('Error fetching post details: ' . $e->getMessage());
            $post = null;
        }

        // Return the view with the post data
        return view('posts.show', compact('post'));
    }



    public function submitPostTEST(Request $request)
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
            //'featured_image' => $validated['featured_image'],
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

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');

            // Log file details for debugging
            Log::info('Featured image uploaded', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);

            // Add file to data for multipart/form-data request
            $data['featured_image'] = new \CURLFile(
                $file->getPathname(),
                $file->getMimeType(),
                $file->getClientOriginalName()
            );
        }


        // Log the data that is about to be sent to the external API
        Log::info('Sending data to external API', [
            'data' => $data,
        ]);

        // Make the POST request to the external API
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
                'Content-Type' => 'multipart/form-data',
            ])->attach(
                'featured_image',
                file_get_contents($file->getPathname()),
                $file->getClientOriginalName()
            )->post($apiUrl, $data);

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


    public function listPendingPosts()
    {
        $jwtToken = session('api_token'); // Retrieve the JWT token from the session
        Log::info('JWT Token:', ['token' => $jwtToken]); // Log the token

        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Define the API endpoint to fetch pending posts
        $apiUrl = config('api.base_url') . '/pending/posts';
        Log::info('API URL:', ['url' => $apiUrl]); // Log the API URL

        try {
            // Make an API call to the /pending/posts endpoint to fetch the posts
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post($apiUrl, [
                'page' => 1,  // Default to the first page
                'per_page' => 100,  // Default to 10 posts per page
            ]);


            // Log full response for debugging
            // Log::info('Full API Response:', [
            //     'status' => $response->status(),
            // ]);

            // Check if the response was successful
            if ($response->successful()) {
                // Extract posts and pagination data from the response
                $responseData = $response->json();

                // Log detailed response data structure
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
            } else {
                // If the response failed, handle the error
                if ($response->status() == 403) {
                    return redirect()->route('user.login')->with('error', 'Access denied. Admins only.');
                }
                $postsData = [];
                $pagination = [];
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching pending posts: ' . $e->getMessage());
            $postsData = [];
            $pagination = [];
        }

        // Pass response data to the view
        return view('admin.pending-post', [
            'postsData' => $postsData,
            'pagination' => $pagination,
            'rawResponseData' => $responseData ?? null, // Pass raw response for debugging
        ]);
    }



    public function listPublishedPosts()
    {
        // Log for debugging
        Log::info('Fetching published posts...');

        $apiUrl = config('api.base_url') . '/posts/published';
        Log::info('API URL for published posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to the /published/posts endpoint to fetch the posts
            $response = Http::get($apiUrl, [
                'per_page' => 100,
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

                // Directly print the data for debugging
                print_r($postsData);
                print_r($pagination);

                // Exit to prevent further execution and avoid the response return
                exit();
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

        // Comment out or remove this line to prevent returning the JSON response:
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Published posts fetched successfully',
        //     'data' => [
        //         'posts' => $postsData,
        //         'pagination' => $pagination
        //     ]
        // ]);
    }


    public function approvePost($slug)
    {
        $jwtToken = session('api_token'); // Retrieve the JWT token from the session
        Log::info('JWT Token:', ['token' => $jwtToken]); // Log the token

        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Define the API endpoint to approve the post
        $apiUrl = config('api.base_url') . '/posts/' . $slug . '/approve';
        Log::info('API URL:', ['url' => $apiUrl]); // Log the API URL

        try {
            // Make an API call to the /approve/post/{slug} endpoint to approve the post
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post($apiUrl);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Check if the post was approved successfully
                if ($responseData['status'] == 'success') {
                    Log::info('Post approved successfully.', ['slug' => $slug]);

                    // Redirect the user to the dashboard with a success message
                    return redirect()->route('admin.dashboard')->with('success', 'Post approved successfully.');
                } else {
                    Log::error('Failed to approve post.', ['slug' => $slug, 'message' => $responseData['message']]);
                    return back()->with('error', 'Failed to approve the post.');
                }
            } else {
                // Handle failure (e.g., unauthorized or bad request)
                if ($response->status() == 403) {
                    return redirect()->route('user.login')->with('error', 'Access denied. Admins only.');
                }
                Log::error('API call failed', ['status' => $response->status(), 'response' => $response->json()]);
                return back()->with('error', 'An error occurred while approving the post.');
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error approving post: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while approving the post.');
        }
    }


    public function deletePost($slug)
    {
        $jwtToken = session('api_token'); // Retrieve the JWT token from the session
        Log::info('JWT Token:', ['token' => $jwtToken]); // Log the token

        // If there's no JWT token, prompt the user to log in
        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Define the API endpoint to delete the post
        $apiUrl = config('api.base_url') . '/posts/' . $slug . '/delete';
        Log::info('API URL:', ['url' => $apiUrl]); // Log the API URL

        try {
            // Make an API call to the /delete/post/{slug} endpoint to delete the post
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->delete($apiUrl);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Check if the post was deleted successfully
                if ($responseData['status'] == 'success') {
                    Log::info('Post deleted successfully.', ['slug' => $slug]);

                    // Redirect back to the admin dashboard with a success message
                    return redirect()->route('admin.dashboard')->with('success', 'Post deleted successfully.');
                } else {
                    Log::error('Failed to delete post.', ['slug' => $slug, 'message' => $responseData['message']]);
                    return back()->with('error', 'Failed to delete the post.');
                }
            } else {
                // Handle failure (e.g., unauthorized or bad request)
                if ($response->status() == 403) {
                    return redirect()->route('user.login')->with('error', 'Access denied. Admins only.');
                }
                Log::error('API call failed', ['status' => $response->status(), 'response' => $response->json()]);
                return back()->with('error', 'An error occurred while deleting the post.');
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error deleting post: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the post.');
        }
    }






    // End of the class
}
