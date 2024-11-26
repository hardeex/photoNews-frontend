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


    public function index(Request $request)
    {
        // Call listPendingPosts to get posts data and pagination
        //$data = $this->listPendingPosts($request);

        //return view('welcome', $data);
        return view('welcome');
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
