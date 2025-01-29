<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;


class CelebrationController extends Controller
{
    public function createBirthday()
    {
        return view("birthday.create");
    }

    public function submitBirthday(Request $request)
    {
        Log::info('Birthday Post submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',  // Name of the birthday celebrant
            'celebrant_age' => 'required|integer|min:0',  // Age of the birthday celebrant
            'dob' => 'required|date',  // Date of Birth
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',  // Featured Image
            'content' => 'required|string',  // Description of the birthday event
            'event_location' => 'nullable|string|max:255',  // Event location (if available)
            'rsvp' => 'nullable|string',  // RSVP details or instructions
            'gift_suggestions' => 'nullable|string',  // Gift suggestions for the celebrant
            'is_featured' => 'nullable|boolean',  // Whether the post is featured
            'is_draft' => 'nullable|boolean',  // Whether the post is in draft mode
            'is_scheduled' => 'nullable|boolean',  // Whether the post is scheduled
            'scheduled_time' => 'nullable|date|after:now',  // Scheduled time for the post to be published
            'allow_comments' => 'nullable|boolean',  // Whether to allow comments
            'meta_title' => 'nullable|string|max:155',  // Meta title for SEO
            'meta_description' => 'nullable|string|max:155',  // Meta description for SEO
            'review_feedback' => 'nullable|string',  // Review feedback (for admin use)
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
            'slug' => ($validated['title']),
            'celebrant_age' => $validated['celebrant_age'],
            'dob' => $validated['dob'],
            'content' => $validated['content'],
            'event_location' => $validated['event_location'] ?? null,
            'rsvp' => $validated['rsvp'] ?? null,
            'gift_suggestions' => $validated['gift_suggestions'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_draft' => $validated['is_draft'] ?? false,
            'is_scheduled' => $validated['is_scheduled'] ?? false,
            'scheduled_time' => $validated['scheduled_time'] ?? null,
            'allow_comments' => $validated['allow_comments'] ?? true,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'review_feedback' => $validated['review_feedback'] ?? null,
        ];

        Log::info('Request Payload:', $formData);

        // API URL for post submission
        $apiUrl = config('api.base_url') . '/submit/birthday';
        Log::info('Connecting to API URL for birthday post creation', [
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
                Log::info('Birthday Post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Birthday Post created successfully!');
            } else {
                // Handle API errors
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred creating the birthday post.',
                ]);
                return back()->withErrors(['error' => $response->json()['message'] ?? 'An error occurred.']);
            }
        } catch (\Exception $e) {
            // Log any exceptions during the API call
            Log::error('API request failed', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => 'An error occurred while submitting the birthday post.']);
        }
    }

    public function listBirthdayPosts(Request $request)
    {
        Log::info('Fetching Birthday Posts...');

        $apiUrl = config('api.base_url') . '/posts/birthday';  // Make sure base_url is correct in your config
        Log::info('API URL for birthday posts:', ['url' => $apiUrl]);

        try {
            // Make the GET request to the API
            $response = Http::get($apiUrl, [
                'per_page' => 12, // 12 items per page
                'page' => $request->get('page', 1), // Default to page 1 if not provided
                'order' => 'desc', // You might want to adjust this if not needed in the backend
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                $responseData = $response->json();  // Parse the JSON response

                // Log the raw response data for debugging (you can comment this line after debugging)
                Log::info('Fetched birthday posts:', ['data' => $responseData]);

                // Extract posts and pagination data
                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [
                    'total' => 0,
                    'per_page' => 12,
                    'current_page' => 1,
                    'last_page' => 1,
                    'next_page_url' => null,
                    'prev_page_url' => null,
                ];

                // Debug the response data to inspect before rendering
                // dd($responseData);  


                return view('birthday.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination
                ]);
            } else {
                // Log if the response is not successful
                Log::error('Error fetching birthday posts:', ['status' => $response->status()]);
                return view('birthday.lists', [
                    'postsData' => [],
                    'pagination' => ['total' => 0, 'per_page' => 12]
                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions if something goes wrong with the request
            Log::error('Error fetching birthday posts:', ['message' => $e->getMessage()]);
            return view('birthday.lists', [
                'postsData' => [],
                'pagination' => ['total' => 0, 'per_page' => 12]
            ]);
        }
    }


    public function showBirthdayDetails(Request $request, $slug)
    {
        Log::info('Fetching Birthday post details...', ['slug' => $slug]);

        // Define the API URL for fetching the single post details
        $apiUrl = config('api.base_url') . '/birthday-posts/' . $slug;

        try {
            // Make an API call to fetch post details by slug
            $response = Http::get($apiUrl);

            // Check if the request was successful (HTTP status 2xx)
            if ($response->successful()) {
                // Extract the response body as an array
                $data = $response->json();

                // Check if the 'status' key exists in the response and is 'success'
                if (isset($data['status']) && $data['status'] === 'success') {
                    // The post data is available under 'data'
                    $post = $data['data'] ?? null;

                    // If no post data, return a warning message
                    if (!$post) {
                        Log::warning('Post not found for slug: ' . $slug);
                        return response()->json(['message' => 'Post not found'], 404);
                    }


                    //dd($post);
                    // Return the view with the post data
                    return view('birthday.show', compact('post'));
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

    public function createWedding()
    {
        return view("wedding.create");
    }

    public function submitWedding(Request $request)
    {
        Log::info('Wedding Posts submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string',
            'wedding_date' => 'required|date|after:today',
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_draft' => 'nullable|boolean',
            'is_scheduled' => 'nullable|boolean',
            'scheduled_time' => 'nullable|date|after:now',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:155',
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
            'wedding_date' => $validated['wedding_date'],
            'bride_name' => $validated['bride_name'],
            'groom_name' => $validated['groom_name'],
            'venue' => $validated['venue'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_draft' => $validated['is_draft'] ?? false,
            'is_scheduled' => $validated['is_scheduled'] ?? false,
            'scheduled_time' => $validated['scheduled_time'] ?? null,
            'allow_comments' => $validated['allow_comments'] ?? true,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'review_feedback' => $validated['review_feedback'] ?? null,
        ];

        Log::info('Request Payload:', $validated);  // Before sending to the API

        // API URL for wedding post submission
        $apiUrl = config('api.base_url') . '/submit/wedding';
        Log::info('Connecting to API URL for wedding post creation', [
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
                Log::info('Wedding Post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Wedding Post created successfully!');
            } else {
                // Handle API errors
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred creating wedding post.',
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


    public function listWeddingPosts(Request $request)
    {
        Log::info('Fetching Wedding Posts...');

        $apiUrl = config('api.base_url') . '/posts/wedding';
        Log::info('API URL for wedding posts:', ['url' => $apiUrl]);

        try {
            // Make the GET request to the API
            $response = Http::get($apiUrl, [
                'per_page' => 12, // 12 items per page
                'page' => $request->get('page', 1), // Default to page 1 if not provided
                'order' => 'desc', // You might want to adjust this if not needed in the backend
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                $responseData = $response->json();  // Parse the JSON response

                // Log the raw response data for debugging (you can comment this line after debugging)
                Log::info('Fetched wedding posts:', ['data' => $responseData]);

                // Extract posts and pagination data
                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [
                    'total' => 0,
                    'per_page' => 12,
                    'current_page' => 1,
                    'last_page' => 1,
                    'next_page_url' => null,
                    'prev_page_url' => null,
                ];

                // Debug the response data to inspect before rendering
                //dd($responseData);

                return view('wedding.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination
                ]);
            } else {
                // Log if the response is not successful
                Log::error('Error fetching wedding posts:', ['status' => $response->status()]);
                return view('wedding.lists', [
                    'postsData' => [],
                    'pagination' => ['total' => 0, 'per_page' => 12]
                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions if something goes wrong with the request
            Log::error('Error fetching wedding posts:', ['message' => $e->getMessage()]);
            return view('wedding.lists', [
                'postsData' => [],
                'pagination' => ['total' => 0, 'per_page' => 12]
            ]);
        }
    }


    public function showWeddingDetails(Request $request, $slug)
    {
        Log::info('Fetching Wedding post details...', ['slug' => $slug]);

        // Define the API URL for fetching the single post details
        $apiUrl = config('api.base_url') . '/posts/wedding/' . $slug;

        try {
            // Make an API call to fetch post details by slug
            $response = Http::get($apiUrl);

            // Check if the request was successful (HTTP status 2xx)
            if ($response->successful()) {
                // Extract the response body as an array
                $data = $response->json();

                // Check if the 'status' key exists in the response and is 'success'
                if (isset($data['status']) && $data['status'] === 'success') {
                    // The post data is available under 'data'
                    $post = $data['data'] ?? null;

                    // If no post data, return a warning message
                    if (!$post) {
                        Log::warning('Post not found for slug: ' . $slug);
                        return response()->json(['message' => 'Post not found'], 404);
                    }

                    // dd($post);

                    // Return the view with the post data
                    return view('wedding.show', compact('post'));
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


    public function submitDedication(Request $request)
    {
        Log::info('Child Dedication Post submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255', // Child's name
            'slug' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string', // Dedication message or prayer
            'is_featured' => 'nullable|boolean',
            'is_draft' => 'nullable|boolean',
            'is_scheduled' => 'nullable|boolean',
            'scheduled_time' => 'nullable|date|after:now',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:155',
            'meta_description' => 'nullable|string|max:155',
            'review_feedback' => 'nullable|string',
            'parents_names' => 'required|string|max:255', // Parent names
            'dedication_date' => 'required|date', // Dedication date
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
            'title' => $validated['title'], // Child's name (required)
            'slug' => $validated['slug'], // Slug (required)
            'featured_image' => $validated['featured_image'] ?? null, // Image (nullable)
            'content' => $validated['content'], // Dedication message or prayer (required)
            'is_featured' => $validated['is_featured'] ?? false, // (nullable, default false)
            'is_draft' => $validated['is_draft'] ?? false, // (nullable, default false)
            'is_scheduled' => $validated['is_scheduled'] ?? false, // (nullable, default false)
            'scheduled_time' => $validated['scheduled_time'] ?? null, // Scheduled time (nullable)
            'allow_comments' => $validated['allow_comments'] ?? true, // (nullable, default true)
            'meta_title' => $validated['meta_title'] ?? null, // (nullable)
            'meta_description' => $validated['meta_description'] ?? null, // (nullable)
            'review_feedback' => $validated['review_feedback'] ?? null, // (nullable)
            'parents_names' => $validated['parents_names'], // Parent names (required)
            'dedication_date' => $validated['dedication_date'], // Dedication date (required)
        ];


        Log::info('Request Payload:', $validated);  // Before sending to the API

        // API URL for wedding post submission
        $apiUrl = config('api.base_url') . '/submit/dedication';
        Log::info('Connecting to API URL for dedication post creation', [
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
                Log::info('Child deciation Post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Child Dedication Post created successfully!');
            } else {
                // Handle API errors
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred creating dedication post.',
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


    public function listChildDedicationPosts(Request $request)
    {
        Log::info('Initiating the process to fetch Child Dedication Posts...');

        // Prepare the API endpoint with base URL configuration
        $apiUrl = config('api.base_url') . '/posts/dedication';
        Log::info('Constructed API URL for fetching child dedication posts:', ['url' => $apiUrl]);

        try {
            // Make a GET request to fetch child dedication posts, with pagination
            $response = Http::get($apiUrl, [
                'per_page' => 12, // Fetch 12 posts per page for pagination
                'page' => $request->get('page', 1), // Default to the first page if 'page' is not provided
                'order' => 'desc', // Order the posts in descending order (newest first)
            ]);

            // Check if the response from the API was successful
            if ($response->successful()) {
                $responseData = $response->json();  // Parse the JSON response

                // Log the fetched data to ensure we are capturing the correct response
                Log::info('Child dedication posts fetched successfully:', ['data' => $responseData]);

                // Extract the posts data and pagination details from the response
                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [
                    'total' => 0,
                    'per_page' => 12,
                    'current_page' => 1,
                    'last_page' => 1,
                    'next_page_url' => null,
                    'prev_page_url' => null,
                ];

                //dd($postsData);
                // Return the view with the fetched posts and pagination data
                return view('dedication.lists', [
                    'postsData' => $postsData,
                    'pagination' => $pagination
                ]);
            } else {
                // Log an error if the API request failed
                Log::error('Failed to fetch child dedication posts. API response was not successful:', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                // Return the view with empty data and default pagination (indicating failure)
                return view('child-dedication.lists', [
                    'postsData' => [],
                    'pagination' => ['total' => 0, 'per_page' => 12]
                ]);
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur during the API request
            Log::error('An error occurred while fetching child dedication posts:', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return the view with empty data and default pagination (indicating failure)
            return view('child-dedication.lists', [
                'postsData' => [],
                'pagination' => ['total' => 0, 'per_page' => 12]
            ]);
        }
    }

    public function showDedicationDetails(Request $request, $slug)
    {
        Log::info('Fetching Child Dedication post details...', ['slug' => $slug]);

        // Define the API URL for fetching the single post details
        $apiUrl = config('api.base_url') . '/dedication-post/' . $slug;

        try {
            // Make an API call to fetch post details by slug
            $response = Http::get($apiUrl);

            // Check if the request was successful (HTTP status 2xx)
            if ($response->successful()) {
                // Extract the response body as an array
                $data = $response->json();

                // Check if the 'status' key exists in the response and is 'success'
                if (isset($data['status']) && $data['status'] === 'success') {
                    // The post data is available under 'data'
                    $post = $data['data'] ?? null;

                    // If no post data, return a warning message
                    if (!$post) {
                        Log::warning('Post not found for slug: ' . $slug);
                        return response()->json(['message' => 'Post not found'], 404);
                    }

                    //dd($data);
                    // Return the view with the post data
                    return view('dedication.show', compact('post'));
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
