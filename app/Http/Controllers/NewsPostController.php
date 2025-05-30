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


    public function uploadPhoto()
    {
        return view('admin.upload-photo');
    }


    // public function uploadPhotoNews(Request $request)
    // {
    //     Log::info('Uploading news headline image...');

    //     // Validate the request
    //     $validated = $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $apiUrl = config('api.base_url') . '/upload-photo-news';
    //     Log::info('API URL for image upload:', ['url' => $apiUrl]);

    //     try {
    //         // Get JWT token from session or authentication mechanism
    //         $token = session('api_token'); 

    //         if (!$token) {
    //             Log::error('No JWT token found in session');
    //             return redirect()->route('admin.upload-photo-news')
    //                 ->with('error', 'You must be logged in to upload images');
    //         }

    //         // Make API call to upload image
    //         $response = Http::withToken($token)
    //             ->attach('image', file_get_contents($request->file('image')->getRealPath()), $request->file('image')->getClientOriginalName())
    //             ->post($apiUrl);

    //         if ($response->successful()) {
    //             $responseData = $response->json();
    //             Log::info('Image uploaded successfully', ['response' => $responseData]);

    //             return redirect()->route('upload-photo')
    //                 ->with('success', $responseData['message'])
    //                 ->with('image_url', $responseData['data']['image_url']);
    //         } else {
    //             Log::error('Error uploading image: ' . $response->status());
    //             return redirect()->route('admin.upload-photo-news')
    //                 ->with('error', 'Failed to upload image: ' . ($response->json()['message'] ?? 'Unknown error'));
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error uploading image: ' . $e->getMessage());
    //         return redirect()->route('admin.upload-photo-news')
    //             ->with('error', 'An error occurred during image upload: ' . $e->getMessage());
    //     }
    // }


    public function uploadPhotoNews(Request $request)
    {
        Log::info('Uploading news headline image...');

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $apiUrl = config('api.base_url') . '/upload-photo-news';
        Log::info('API URL for image upload:', ['url' => $apiUrl]);

        try {
            $token = session('api_token');
            if (!$token) {
                Log::error('No JWT token found in session');
                return redirect()->route('admin.upload-photo-news')
                    ->with('error', 'You must be logged in to upload images');
            }

            $response = Http::withToken($token)
                ->attach('image', file_get_contents($request->file('image')->getRealPath()), $request->file('image')->getClientOriginalName())
                ->post($apiUrl);

            if ($response->successful()) {
                $responseData = $response->json();
                Log::info('Image uploaded successfully', ['response' => $responseData]);
                return redirect()->route('upload-photo')
                    ->with('success', $responseData['message'])
                    ->with('image_url', $responseData['data']['image_url']);
            } else {
                Log::error('Error uploading image: ' . $response->status());
                return redirect()->route('admin.upload-photo-news')
                    ->with('error', 'Failed to upload image: ' . ($response->json()['message'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('Error uploading image: ' . $e->getMessage());
            return redirect()->route('admin.upload-photo-news')
                ->with('error', 'An error occurred during image upload: ' . $e->getMessage());
        }
    }

    public function showLatestImage()
    {
        Log::info('Fetching latest image...');

        $apiUrl = config('api.base_url') . '/latest-image';
        Log::info('API URL for latest image:', ['url' => $apiUrl]);

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $responseData = $response->json();
                $image = $responseData['data'] ?? null;
                return view('welcome', [
                    'image' => $image,
                ]);
            } else {
                Log::error('Error fetching latest image: ' . $response->status());
                return view('news.latest-image', [
                    'image' => null,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching latest image: ' . $e->getMessage());
            return view('news.latest-image', [
                'image' => null,
            ]);
        }
    }

    public function showAllImages()
    {
        Log::info('Fetching all images for admin...');

        $apiUrl = config('api.base_url') . '/images';
        Log::info('API URL for all images:', ['url' => $apiUrl]);

        try {
            $token = session('api_token');
            if (!$token) {
                Log::error('No JWT token found in session');
                return redirect()->route('admin.images')
                    ->with('error', 'You must be logged in to view images');
            }

            $response = Http::withToken($token)->get($apiUrl);

            if ($response->successful()) {
                $responseData = $response->json();
                $images = $responseData['data'] ?? [];
                return view('admin.manage-photo', [
                    'images' => $images,
                ]);
            } else {
                Log::error('Error fetching all images: ' . $response->status());
                return view('admin.manage-photo', [
                    'images' => [],
                ])->with('error', $response->json()['message'] ?? 'Failed to fetch images');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching all images: ' . $e->getMessage());
            return view('admin.manage-photo', [
                'images' => [],
            ])->with('error', 'An error occurred while fetching images');
        }
    }



    public function createPost()
    {
        $jwtToken = session('api_token');
        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Fetch categories using the private method
        $categories = $this->fetchCategories();

        // Sort categories alphabetically by name
        usort($categories, function ($a, $b) {
            return strcasecmp($a['name'], $b['name']); // Case-insensitive sort
        });

        // Convert category names to title case
        foreach ($categories as &$category) {
            $category['name'] = ucwords(strtolower($category['name'])); // Convert to title case
        }

        return view('news.create-post', compact('categories'));
    }

    // Method to fetch categories from the external API
    private function fetchCategories()
    {
        // Get the base URL from config
        $baseUrl = config('api.base_url');

        // Get the full URL for the category-seeder endpoint
        $url = $baseUrl . '/category-seeder';

        // Fetch the categories using the HTTP client
        $response = Http::get($url);

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json(); // Return the categories data as an array
        } else {
            //  handle failure and return an empty array or error
            return [];
        }
    }


    public function newsCategoryList(Request $request)
    {
        Log::info('Fetching published posts...');

        $apiUrl = config('api.base_url') . '/posts/published';
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

                return view('news.show', [
                    'postsData' => $postsData,
                    'pagination' => $pagination,
                    'totalPublishedPosts' => $totalPublishedPosts,
                ]);
            } else {
                // If the response failed, handle the error
                Log::error('Error fetching published posts: ' . $response->status());
                return view('news.show', [
                    'postsData' => [],
                    'pagination' => [],
                    'totalPublishedPosts' => 0,
                ]);
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching published posts: ' . $e->getMessage());
            return view('news.show', [
                'postsData' => [],
                'pagination' => [],
                'totalPublishedPosts' => 0,
            ]);
        }
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




    public function createCategorySeeder()
    {
        $jwtToken = session('api_token');
        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Original endpoint to get categories for creation (keep existing variable name)
        $apiUrl = config('api.base_url') . '/category-seeder';
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($apiUrl);

            if ($response->successful()) {
                $categories = $response->json()['data']['categories'] ?? [];  // Fetch categories

                // Convert each category name to title case
                $categories = array_map(function ($category) {
                    $category['name'] = ucwords(strtolower($category['name'])); // Title case for each category name
                    return $category;
                }, $categories);

                Log::info('Fetched categories seeder for creation: ' . json_encode($categories));
            } else {
                $categories = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching categories seeder for creation: ' . $e->getMessage());
            $categories = [];
        }

        // New endpoint to list categories for display (new variable name)
        $listCategoriesUrl = config('api.base_url') . '/list-categories-seeder'; // the one with pagination
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($listCategoriesUrl);

            if ($response->successful()) {
                $data = $response->json()['data'] ?? [];
                $categoriesForDisplay = $data['categories'] ?? []; // Categories list
                $pagination = $data['pagination'] ?? []; // Pagination details

                // Convert each category name to title case for display
                $categoriesForDisplay = array_map(function ($category) {
                    $category['name'] = ucwords(strtolower($category['name'])); // Title case for each category name
                    return $category;
                }, $categoriesForDisplay);

                Log::info('Fetched categories for display: ' . json_encode($categoriesForDisplay));
                Log::info('Pagination data: ' . json_encode($pagination));
            } else {
                $categoriesForDisplay = [];
                $pagination = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching categories for display: ' . $e->getMessage());
            $categoriesForDisplay = [];
            $pagination = [];
        }

        // Pass categories and pagination to the view
        return view('news.category-seeder', compact('categories', 'categoriesForDisplay', 'pagination'));
    }




    public function submitCategorySeeder(Request $request)
    {
        Log::info('Submit category seeder to the endpoint method is called...', [
            'request_data' => $request->all(),  // Log all incoming request data
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',

        ]);

        // Log the validated data before proceeding
        Log::info('Validated category data', [
            'name' => $validated['name'],

        ]);

        // Get the JWT token from session (after login)
        $jwtToken = session('api_token');

        // If the JWT token is missing or expired, redirect to the login page
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for category submission
        $apiUrl = config('api.base_url') . '/create-category-seeder';
        Log::info('Connecting to API URL for category creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare the data to be sent to the API
        $data = [
            'name' => $validated['name'],
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



    public function submitPost(Request $request)
    {
        Log::info('News Posr submission method is called...', [
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

            // added fields


            'is_breaking' => 'boolean',
            'event' => 'nullable|boolean',
            'top_topic' => 'nullable|boolean',
            'hot_gist' => 'nullable|boolean',
            'caveat' => 'nullable|boolean',
            'pride_of_nigeria' => 'nullable|boolean',

            'category_id' => 'nullable',


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

            // added fields


            'is_breaking' => $validated['is_breaking'] ?? false,
            'event' => $validated['event'] ?? false,
            'top_topic' => $validated['top_topic'] ?? false,
            'hot_gist' => $validated['hot_gist'] ?? false,
            'caveat' => $validated['caveat'] ?? false,
            'pride_of_nigeria' => $validated['pride_of_nigeria'] ?? false,

            'category_id' => $validated['category_id'],


        ];


        // print_r($formData);
        // exit();

        Log::info('Request Payload:', $validated);  // Before sending to the API

        // API URL for post submission
        $apiUrl = config('api.base_url') . '/submit-post';
        Log::info('Connecting to API URL for post creation', [
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





    // public function managePosts(Request $request)
    // {
    //     Log::info('Manage Posts method is called...', [
    //         'request_data' => $request->all(),
    //     ]);

    //     // Get the JWT token from session
    //     $jwtToken = session('api_token');

    //     if (empty($jwtToken)) {
    //         Log::warning('JWT token missing or expired');
    //         return redirect()->route('user.login')->with('error', 'Please log in first');
    //     }

    //     $apiUrl = config('api.base_url') . '/user/posts';

    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $jwtToken,
    //         ])->post($apiUrl, $request->all());

    //         if ($response->successful()) {
    //             Log::info('Posts fetched successfully', [
    //                 'response_data' => $response->json(),
    //             ]);

    //             // Get the data from response
    //             $responseData = $response->json();

    //             // Pass both message and posts data to view
    //             return view('posts.mypost', [
    //                 'message' => $responseData['message'],
    //                 'posts' => $responseData['posts']
    //             ]);
    //         } else {
    //             Log::error('Error returned from external API', [
    //                 'status_code' => $response->status(),
    //                 'error_message' => $response->json()['message'] ?? 'An error occurred.',
    //             ]);

    //             return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('API request failed', [
    //             'exception_message' => $e->getMessage(),
    //             'exception_trace' => $e->getTraceAsString(),
    //         ]);

    //         return back()->withErrors(['error' => 'An error occurred while fetching posts.']);
    //     }
    // }



    public function managePosts(Request $request)
    {
        Log::info('Manage Posts method is called...', [
            'request_data' => $request->all(),
        ]);

        // Get the JWT token from session
        $jwtToken = session('api_token');

        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // New API URL for GET request
        $apiUrl = config('api.base_url') . '/user/posts';

        try {
            // Make the GET request with the JWT token in the Authorization header
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($apiUrl, $request->all());

            if ($response->successful()) {
                Log::info('Posts fetched successfully', [
                    'response_data' => $response->json(),
                ]);

                // Get the data from the response
                $responseData = $response->json();

                // Pass the data to the view
                return view('posts.mypost', [
                    'message' => $responseData['message'],
                    'posts' => $responseData['posts']
                ]);
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

            return back()->withErrors(['error' => 'An error occurred while fetching posts.']);
        }
    }

    public function fetchPostForEdit2($slug)
    {
        Log::info('Fetching post for edit with slug: ' . $slug);
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to edit a post.']);
        }

        $jwtToken = session('api_token');
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('login')->with('error', 'Please log in first');
        }

        Log::info('Post slug: ', ['slug' => $slug]);
        try {
            $response = Http::withToken($jwtToken)
                ->get(config('api.base_url') . '/posts/edit/' . $slug);

            Log::info('API response:', ['response' => $response->json()]);

            if ($response->successful()) {
                Log::error('API request failed', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'Unknown error',
                ]);
                $post = $response->json()['post'];

                //dd($post);
                return view('posts.edit', [
                    'post' => $post,
                    'user' => $user
                ]);
            }

            // Handle specific error cases
            $statusCode = $response->status();
            $errorMessage = $response->json()['message'] ?? 'An error occurred';

            if ($statusCode === 403) {
                return redirect()->route('manage-posts')->with('error', 'You are not authorized to edit this post');
            }

            if ($statusCode === 404) {
                return redirect()->route('manage-posts')->with('error', 'Post not found');
            }

            return redirect()->route('manage-posts')->with('error', $errorMessage);
        } catch (\Exception $e) {
            Log::error('Error fetching post for edit', [
                'error' => $e->getMessage(),
                'slug' => $slug
            ]);
            return redirect()->route('manage-posts')->with('error', 'An error occurred while fetching the post');
        }
    }



    public function fetchPostForEdit($slug)
    {
        Log::info('Fetching post for edit with slug: ' . $slug);
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to edit a post.']);
        }

        $jwtToken = session('api_token');
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('login')->with('error', 'Please log in first');
        }

        Log::info('Post slug: ', ['slug' => $slug]);
        try {
            $response = Http::withToken($jwtToken)
                ->get(config('api.base_url') . '/posts/edit/' . $slug);

            Log::info('API response:', ['response' => $response->json()]);

            if ($response->successful()) {
                $post = $response->json()['post'];

                return view('posts.edit', [
                    'post' => $post,
                    'user' => $user
                ]);
            }

            // Move the error log here where it actually is an error
            Log::error('API request failed', [
                'status_code' => $response->status(),
                'error_message' => $response->json()['message'] ?? 'Unknown error',
            ]);

            // Handle specific error cases
            $statusCode = $response->status();
            $errorMessage = $response->json()['message'] ?? 'An error occurred';

            if ($statusCode === 403) {
                return redirect()->route('manage-posts')->with('error', 'You are not authorized to edit this post');
            }

            if ($statusCode === 404) {
                return redirect()->route('manage-posts')->with('error', 'Post not found');
            }

            return redirect()->route('manage-posts')->with('error', $errorMessage);
        } catch (\Exception $e) {
            Log::error('Error fetching post for edit', [
                'error' => $e->getMessage(),
                'slug' => $slug
            ]);
            return redirect()->route('manage-posts')->with('error', 'An error occurred while fetching the post');
        }
    }


    public function updatePost(Request $request, $slug)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Login required']);
        }

        // Create a new array for the request data
        $request_data = $request->except('featured_image');

        // Handle checkbox fields
        $checkboxFields = [
            'is_featured',
            'is_breaking',
            'hot_gist',
            'event',
            'top_topic',
            'pride_of_nigeria',
            'allow_comments'
        ];

        foreach ($checkboxFields as $field) {
            $request_data[$field] = isset($request_data[$field]) ?
                filter_var($request_data[$field], FILTER_VALIDATE_BOOLEAN) :
                false;
        }

        // Handle file upload separately
        if ($request->hasFile('featured_image')) {
            // Validate the file
            $validator = Validator::make($request->all(), [
                'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // Create multipart form data
            $request_data = collect($request_data)->toArray();
            $request_data['featured_image'] = fopen($request->file('featured_image')->getPathname(), 'r');
        }

        try {
            // Use multipart request if there's a file
            if ($request->hasFile('featured_image')) {
                $response = Http::withToken(session('api_token'))
                    ->attach(
                        'featured_image',
                        file_get_contents($request->file('featured_image')->getPathname()),
                        $request->file('featured_image')->getClientOriginalName()
                    )
                    ->put(config('api.base_url') . '/posts/update/' . $slug, $request_data);
            } else {
                $response = Http::withToken(session('api_token'))
                    ->put(config('api.base_url') . '/posts/update/' . $slug, $request_data);
            }

            if ($response->successful()) {
                $responseData = $response->json();
                return redirect()
                    ->route('manage.posts')
                    ->with('success', $responseData['message'] ?? 'Post updated successfully');
            }

            $errorResponse = $response->json();
            $errorMessage = $errorResponse['message'] ?? 'Update failed';
            $validationErrors = $errorResponse['errors'] ?? [];

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $errorMessage,
                    'validation_errors' => $validationErrors
                ]);
        } catch (\Exception $e) {
            Log::error('Post update exception', [
                'error_message' => $e->getMessage(),
                'slug' => $slug,
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updatePost2(Request $request, $slug)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Login required']);
        }

        $request_data = $request->all();
        $checkboxFields = [
            'is_featured',
            'is_breaking',
            'hot_gist',
            'event',
            'top_topic',
            'pride_of_nigeria',
            'allow_comments'
        ];

        foreach ($checkboxFields as $field) {
            $request_data[$field] = isset($request_data[$field]) ?
                filter_var($request_data[$field], FILTER_VALIDATE_BOOLEAN) :
                false;
        }

        try {
            $response = Http::withToken(session('api_token'))
                ->put(config('api.base_url') . '/posts/update/' . $slug, $request_data);

            if ($response->successful()) {
                $responseData = $response->json();
                return redirect()
                    ->route('manage.posts')
                    ->with('success', $responseData['message'] ?? 'Post updated successfully');
            }

            $errorResponse = $response->json();
            $errorMessage = $errorResponse['message'] ?? 'Update failed';
            $validationErrors = $errorResponse['errors'] ?? [];

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $errorMessage,
                    'validation_errors' => $validationErrors
                ]);
        } catch (\Exception $e) {
            Log::error('Post update exception', [
                'error_message' => $e->getMessage(),
                'slug' => $slug,
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function deletePost($slug)
    {
        Log::info('The delete method for newsPosts is called with slug');
        $user = session('user');
        $jwtToken = session('api_token');

        if (!$user || empty($jwtToken)) {
            Log::warning('User not authenticated or JWT token missing');
            return response()->json(['error' => 'Authentication required'], 401);
        }

        Log::info('Deleting post', ['slug' => $slug, 'user_id' => $user['id']]);

        try {
            $response = Http::withToken($jwtToken)
                ->delete(config('api.base_url') . '/posts/delete/' . $slug);

            Log::info('API response for deleting post', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);

            if ($response->successful()) {
                return response()->json([
                    'message' => 'Post deleted successfully',
                    'slug' => $slug
                ], 200);
            }

            $errorMessage = $response->json()['message'] ?? 'Failed to delete post';
            return response()->json(['error' => $errorMessage], $response->status());
        } catch (\Exception $e) {
            Log::error('Error deleting post', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'error' => 'Error occurred while deleting the post'
            ], 500);
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


    public function deletePost2($slug)
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



    public function youtubeLink()
    {
        $videos = $this->getLiveVideos(); // Call the private method to fetch live videos
        return view('editor.youtubeLink', ['videos' => $videos]);
    }

    // Private method to get live videos
    private function getLiveVideos()
    {
        $jwtToken = session('api_token'); // Retrieve the JWT token from the session
        Log::info('JWT Token:', ['token' => $jwtToken]); // Log the token

        if (empty($jwtToken)) {
            return []; // If the JWT token is not available, return an empty array
        }

        // Define the API endpoint to get live videos
        $apiUrl = config('api.base_url') . '/list/youtube/links';
        Log::info('API URL:', ['url' => $apiUrl]); // Log the API URL

        try {
            // Make an API call to the /live/videos endpoint to fetch live videos
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($apiUrl);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Check if videos were returned successfully
                if (isset($responseData['video']) && count($responseData['video']) > 0) {
                    Log::info('Live videos fetched successfully.', ['videos' => $responseData['video']]);
                    return $responseData['video']; // Return the videos
                } else {
                    Log::error('No videos found.');
                    return []; // Return an empty array if no videos are found
                }
            } else {
                // Handle failure (e.g., unauthorized or bad request)
                if ($response->status() == 403) {
                    return redirect()->route('user.login')->with('error', 'Access denied. Please log in again.');
                }
                Log::error('API call failed', ['status' => $response->status(), 'response' => $response->json()]);
                return []; // Return an empty array if the API call fails
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching live videos: ' . $e->getMessage());
            return []; // Return an empty array if an exception occurs
        }
    }



    public function submitYoutubeLink(Request $request)
    {
        $jwtToken = session('api_token');
        Log::info('JWT Token:', ['token' => $jwtToken]);

        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        $apiUrl = config('api.base_url') . '/post/youtube/link'; // Fixed to singular "post"
        Log::info('API URL: ' . $apiUrl);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|in:news,tutorials,entertainment,educational,other',
            'description' => 'nullable|string',
            'featured' => 'boolean',
            'youtube_url' => 'required|url'
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post($apiUrl, $validated);

            Log::info('API Response:', ['response' => $response->json()]);

            if ($response->successful()) {
                $responseData = $response->json();
                if ($responseData['message'] == 'YouTube video added successfully') {
                    Log::info('YouTube video submitted successfully.');
                    return redirect()->back()->with('success', 'YouTube video added successfully.');
                } else {
                    Log::error('Failed to add YouTube video.', ['message' => $responseData['message']]);
                    return back()->with('error', 'Failed to add the YouTube video.');
                }
            } else {
                Log::error('API call failed', ['status' => $response->status(), 'response' => $response->json()]);
                if ($response->status() == 403) {
                    return redirect()->route('user.login')->with('error', 'Access denied. Please log in again.');
                }
                return back()->with('error', 'An error occurred while submitting the YouTube video.');
            }
        } catch (\Exception $e) {
            Log::error('Error submitting YouTube video: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while submitting the YouTube video.');
        }
    }



    public function getLiveVideos2()
    {
        $jwtToken = session('api_token'); // Retrieve the JWT token from the session
        Log::info('JWT Token:', ['token' => $jwtToken]); // Log the token

        if (empty($jwtToken)) {
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Define the API endpoint to get live videos
        $apiUrl = config('api.base_url') . '/list/youtube/links';
        Log::info('API URL:', ['url' => $apiUrl]); // Log the API URL

        try {
            // Make an API call to the /live/videos endpoint to fetch live videos
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get($apiUrl);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Check if videos were returned successfully
                if (isset($responseData['video']) && count($responseData['video']) > 0) {
                    Log::info('Live videos fetched successfully.', ['videos' => $responseData['video']]);
                    return view('editor.youtubeLink', ['videos' => $responseData['video']]);
                } else {
                    Log::error('No videos found.');
                    return back()->with('error', 'No live videos found.');
                }
            } else {
                // Handle failure (e.g., unauthorized or bad request)
                if ($response->status() == 403) {
                    return redirect()->route('user.login')->with('error', 'Access denied. Please log in again.');
                }
                Log::error('API call failed', ['status' => $response->status(), 'response' => $response->json()]);
                return back()->with('error', 'An error occurred while fetching live videos.');
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching live videos: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching live videos.');
        }
    }



    // End of the class
}
