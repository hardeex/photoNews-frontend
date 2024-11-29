<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected $postsData = [];
    protected $pagination = [];


    public function dashboard()
    {
        return view('user.dashboard');
    }



    public function indexOPTION1(Request $request)
    {
        // Call listPendingPosts to get posts data and pagination
        return $this->listPendingPosts($request);
    }

    public function listPendingPostsOPTION1(Request $request)
    {
        $apiUrl = config('api.base_url') . '/pending/posts';

        try {
            // Make the API call
            $response = Http::get($apiUrl, [
                'page' => $request->get('page', 1),
                'per_page' => 10,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $postsData = $data['data'] ?? [];
                $pagination = $data['pagination'] ?? [];
            } else {
                $postsData = [];
                $pagination = [];
            }
        } catch (\Exception $e) {
            // Handle error
            Log::error('Error fetching pending posts: ' . $e->getMessage());
            $postsData = [];
            $pagination = [];
        }

        // Return the view with the data
        return view('welcome', compact('postsData', 'pagination'));
    }

    // OPTION 2 FOR PASSING THE DATA
    public function indexOPTION2(Request $request)
    {
        // Ensure that listPendingPosts is called to populate data
        $this->listPendingPosts($request);

        return view('welcome', [
            'postsData' => $this->postsData,
            'pagination' => $this->pagination,
        ]);
    }

    public function listPendingPostsOPTION2(Request $request)
    {
        $apiUrl = config('api.base_url') . '/pending/posts';

        try {
            // Make the API call
            $response = Http::get($apiUrl, [
                'page' => $request->get('page', 1),
                'per_page' => 10,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->postsData = $data['data'] ?? [];
                $this->pagination = $data['pagination'] ?? [];
            } else {
                $this->postsData = [];
                $this->pagination = [];
            }
        } catch (\Exception $e) {
            // Handle error
            Log::error('Error fetching pending posts: ' . $e->getMessage());
            $this->postsData = [];
            $this->pagination = [];
        }
    }


    //     public function index(Request $request)
    // {
    //     // Fetch the existing published posts
    //     $response = $this->listPublishedPosts();

    //     // Extract posts data and pagination
    //     $postsData = $response['postsData'] ?? [];
    //     $pagination = $response['pagination'] ?? [];

    //     // Fetch the posts that are approved and is_breaking is true
    //     $breakingPostsData = $this->listBreakingPosts();

    //     // Pass both sets of posts data to the view
    //     return view('welcome', compact('postsData', 'pagination', 'breakingPostsData'));
    // }


    public function index(Request $request)
    {
        // Fetch the existing published posts
        $response = $this->listPublishedPosts();

        // Extract posts data and pagination
        $postsData = $response['postsData'] ?? [];
        $pagination = $response['pagination'] ?? [];

        // Fetch the posts that are approved and is_breaking is true
        $breakingPostsData = $this->listBreakingPosts();

        // Fetch the approved music posts
        $musicPostsData = $this->listApprovedMusicPosts();

        // Pass both sets of posts data to the view
        return view('welcome', compact('postsData', 'pagination', 'musicPostsData', 'breakingPostsData'));
    }

    private function listApprovedMusicPosts()
    {
        // Log for debugging
        Log::info('Fetching approved music posts...');

        $apiUrl = config('api.base_url') . '/posts/approved'; // Assuming the endpoint supports filtering by status
        Log::info('API URL for approved music posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch approved posts with 'category' = 'music'
            $response = Http::get($apiUrl, [
                'per_page' => 3,    // Limit the result to 3 posts
                'status' => 'approved',
                'category' => 'music', // Assuming the API allows category filtering
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract music posts data
                $musicPostsData = $responseData['data']['posts'] ?? [];

                // Return the data
                return $musicPostsData;
            } else {
                Log::error('Error fetching approved music posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved music posts: ' . $e->getMessage());
            return [];
        }
    }


    private function listBreakingPosts()
    {
        // Log for debugging
        Log::info('Fetching breaking approved posts...');

        $apiUrl = config('api.base_url') . '/posts/approved'; // Assuming the endpoint supports filtering by status
        Log::info('API URL for approved breaking posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'is_breaking' = true
            $response = Http::get($apiUrl, [
                'per_page' => 100,
                'is_breaking' => true, // Assuming the API allows such filters
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data and pagination info
                $breakingPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // Return the data
                return $breakingPostsData;
            } else {
                Log::error('Error fetching approved breaking posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved breaking posts: ' . $e->getMessage());
            return [];
        }
    }


    //     public function index(Request $request)
    //     {

    //         $response = $this->listPublishedPosts();

    //         // Extract posts data and pagination\
    //         $postsData = $response['postsData'] ?? [];
    //         $pagination = $response['pagination'] ?? [];

    //         // Pass the posts data to the view
    //         return view('welcome', compact('postsData', 'pagination'));
    //     }


    private function listPublishedPosts()
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

                // Extract posts data and pagination info
                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // Return the data
                return [
                    'postsData' => $postsData,
                    'pagination' => $pagination
                ];
            } else {
                // If the response failed, handle the error
                Log::error('Error fetching published posts: ' . $response->status());
                return [
                    'postsData' => [],
                    'pagination' => []
                ];
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching published posts: ' . $e->getMessage());
            return [
                'postsData' => [],
                'pagination' => []
            ];
        }
    }


    public function listPendingPostsJSON(Request $request)
    {
        $apiUrl = config('api.base_url') . '/pending/posts';

        try {
            // Make the API call
            $response = Http::get($apiUrl, [
                'page' => $request->get('page', 1),
                'per_page' => 10,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'postsData' => $data['data'] ?? [],
                    'pagination' => $data['pagination'] ?? [],
                ];
            } else {
                return [
                    'postsData' => [],
                    'pagination' => [],
                ];
            }
        } catch (\Exception $e) {
            // Handle error
            Log::error('Error fetching pending posts: ' . $e->getMessage());
            return [
                'postsData' => [],
                'pagination' => [],
            ];
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
                'Authorization' => 'Bearer ' . $jwtToken, // Include the JWT token in the request header
            ])->get($apiUrl, [
                'page' => 1, // Default to the first page
                'per_page' => 10, // Default to 10 posts per page
            ]);

            // Log full response for debugging
            Log::info('Full API Response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                // Extract posts and pagination data from the response
                $responseData = $response->json();

                // More detailed logging
                Log::info('Response Data Structure:', [
                    'keys' => array_keys($responseData),
                    'data_keys' => isset($responseData['data']) ? array_keys($responseData['data']) : 'No data key'
                ]);

                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                Log::info('Processed Posts Data:', [
                    'posts_count' => count($postsData),
                    'pagination' => $pagination
                ]);
            } else {
                // If the response failed, handle the error (e.g., unauthorized or forbidden)
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

        // Debugging in the view
        return view('posts.pending-posts', [
            'postsData' => $postsData,
            'pagination' => $pagination,
            'rawResponseData' => $responseData ?? null // Pass raw response for debugging
        ]);
    }







    // public function listPendingPosts()
    // {
    //     $jwtToken = session('api_token'); // Retrieve the JWT token from the session
    //     if (empty($jwtToken)) {
    //         return redirect()->route('user.login')->with('error', 'Please log in first');
    //     }

    //     // Define the API endpoint to fetch pending posts
    //     $apiUrl = config('api.base_url') . '/pending/posts';

    //     try {
    //         // Make an API call to the /pending/posts endpoint to fetch the posts
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $jwtToken, // Include the JWT token in the request header
    //         ])->get($apiUrl, [
    //             'page' => 1, // Default to the first page
    //             'per_page' => 10, // Default to 10 posts per page
    //         ]);

    //         // Check if the response was successful
    //         if ($response->successful()) {
    //             $postsData = $response->json()['data']['posts'] ?? []; // Access posts correctly
    //             $pagination = $response->json()['data']['pagination'] ?? []; // Access pagination correctly

    //             // Log the fetched data
    //             Log::info('Fetched pending posts: ', ['posts_count' => count($postsData), 'pagination' => $pagination]);

    //             // Return the posts data and pagination
    //             return compact('postsData', 'pagination');
    //         } else {
    //             // If the response failed, return empty arrays
    //             return ['postsData' => [], 'pagination' => []];
    //         }
    //     } catch (\Exception $e) {
    //         // Handle any errors that occur during the request
    //         Log::error('Error fetching pending posts: ' . $e->getMessage());
    //         return ['postsData' => [], 'pagination' => []];
    //     }
    // }





    // The main index method to render the welcome view
    public function index4(Request $request)
    {
        // Fetch data for pending posts
        $pendingPosts = $this->listPendingPosts($request);

        // Return the 'welcome' view with the pending posts data
        return view('welcome', compact('pendingPosts'));
    }

    // Method to fetch the pending posts from the API
    private function listPendingPosts4(Request $request)
    {
        $apiUrl = config('api.base_url') . '/pending/posts';

        try {
            // Make the API request
            $response = Http::get($apiUrl, [
                'page' => $request->get('page', 1),
                'per_page' => 10,
            ]);

            // If the API call is successful, extract the data
            if ($response->successful()) {
                $data = $response->json();
                $postsData = $data['data'] ?? []; // Posts data from the API response
                $pagination = $data['pagination'] ?? []; // Pagination data

                return compact('postsData', 'pagination');
            }
        } catch (\Exception $e) {
            // If there's an error in fetching the data, log the error
            Log::error('Error fetching pending posts: ' . $e->getMessage());
        }

        // Return empty arrays if something goes wrong
        return ['postsData' => [], 'pagination' => []];
    }
}
