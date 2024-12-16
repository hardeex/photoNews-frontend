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

        // Fetch the posts that are approved and hot_gist is true
        $hotGistsPostsData = $this->listHotGistsPosts();


        // Fetch the posts that are approved and event is true
        $eventsPostsData = $this->listEventsPosts();

        // fetch caveat posts
        $caveatPostsData = $this->listCaveatPosts();


        // Fetch the approved music posts
        $musicPostsData = $this->listApprovedMusicPosts();

        // Fetch the approved local posts
        $localPostsData = $this->listApprovedLocalPosts();

        // Fetch the approved local posts
        $internationalPostsData = $this->listApprovedInternationalPosts();

        // Fetch the posts that are approved and event is true
        $topTopicPostsData = $this->listTopTopicPosts();


        // fetch the categories
        $categories = $this->listCategories($request);

        // public notice
        $publicNotice = $this->listPublicNoticePosts();

        // lost and found
        $lostAndFoundPostData = $this->listLostAndFoundPostData();

        // list obituary posts
        $listObituaryPostsData = $this->listObituaryPosts();

        // Pass both sets of posts data to the view
        return view('welcome', compact(
            'postsData',
            'pagination',
            'musicPostsData',
            'breakingPostsData',
            'localPostsData',
            'internationalPostsData',
            'hotGistsPostsData',
            'eventsPostsData',
            'categories',
            'topTopicPostsData',
            'publicNotice',
            'caveatPostsData',
            'lostAndFoundPostData',
            'listObituaryPostsData'
        ));
    }

    private function listApprovedMusicPosts()
    {
        // Log for debugging
        Log::info('Fetching approved music posts...');

        $apiUrl = config('api.base_url') . '/posts/music'; // Assuming the endpoint supports filtering by status
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


    private function listApprovedLocalPosts()
    {
        // Log for debugging
        Log::info('Fetching approved local posts...');

        $apiUrl = config('api.base_url') . '/posts/local';
        Log::info('API URL for approved local posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch approved posts with 'category' = 'music'
            $response = Http::get($apiUrl, [
                'per_page' => 3,    // Limit the result to 3 posts
                'status' => 'approved',
                'category' => 'local', // Assuming the API allows category filtering
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract music posts data
                $localPostsData = $responseData['data']['posts'] ?? [];
                // print_r($localPostsData);
                // exit();

                // Return the data
                return $localPostsData;
            } else {
                Log::error('Error fetching approved local posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved local posts: ' . $e->getMessage());
            return [];
        }
    }


    private function  listApprovedInternationalPosts()
    {
        // Log for debugging
        Log::info('Fetching approved international posts...');

        $apiUrl = config('api.base_url') . '/posts/international';
        Log::info('API URL for approved international posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch approved posts with 'category' = 'international'
            $response = Http::get($apiUrl, [
                'per_page' => 3,    // Limit the result to 3 posts
                'status' => 'approved',
                'category' => 'international', // Assuming the API allows category filtering
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract music posts data
                $internationalPostsData = $responseData['data']['posts'] ?? [];
                // print_r($localPostsData);
                // exit();

                // Return the data
                return $internationalPostsData;
            } else {
                Log::error('Error fetching approved local posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved local posts: ' . $e->getMessage());
            return [];
        }
    }

    private function listBreakingPosts()
    {
        // Log for debugging
        Log::info('Fetching breaking approved posts...');

        $apiUrl = config('api.base_url') . '/posts/breaking'; // Assuming the endpoint supports filtering by status
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

                // print_r($breakingPostsData);
                // exit();
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


    private function listHotGistsPosts()
    {
        // Log for debugging
        Log::info('Fetching Hot Gists approved posts...');

        $apiUrl = config('api.base_url') . '/posts/hot-gists';
        Log::info('API URL for approved hot gists posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'hot_gist' = true
            $response = Http::get($apiUrl, [
                'per_page' => 100,
                'hot_gist' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data and pagination info
                $hotGistsPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // print_r($hotGistsPostsData);
                // exit();
                //Return the data
                return $hotGistsPostsData;
            } else {
                Log::error('Error fetching approved hot gists posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved hot gists posts: ' . $e->getMessage());
            return [];
        }
    }


    private function listEventsPosts()
    {
        // Log for debugging
        Log::info('Fetching Events approved posts...');

        $apiUrl = config('api.base_url') . '/posts/events';
        Log::info('API URL for approved Events posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'hot_gist' = true
            $response = Http::get($apiUrl, [
                'per_page' => 100,
                'event' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data and pagination info
                $eventsPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // print_r($eventsPostsData);
                // exit();
                //Return the data
                return $eventsPostsData;
            } else {
                Log::error('Error fetching approved Events posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved Events posts: ' . $e->getMessage());
            return [];
        }
    }


    private function listCaveatPosts()
    {
        // Log for debugging
        Log::info('Fetching Caveat approved posts...');

        $apiUrl = config('api.base_url') . '/posts/caveat';
        Log::info('API URL for approved Caveat posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'caveat' = true
            $response = Http::get($apiUrl, [
                'per_page' => 10,
                'event' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data and pagination info
                $caveatPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // print_r($eventsPostsData);
                // exit();
                //Return the data
                return $caveatPostsData;
            } else {
                Log::error('Error fetching approved Events posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved Events posts: ' . $e->getMessage());
            return [];
        }
    }

    private function listTopTopicPosts()
    {
        // Log for debugging
        Log::info('Fetching top topic approved posts...');

        $apiUrl = config('api.base_url') . '/posts/top-topic';
        Log::info('API URL for approved Events posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'top_topic' = true
            $response = Http::get($apiUrl, [
                'per_page' => 100,
                'event' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data and pagination info
                $topTopicPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // print_r($topTopicPostsData);
                // exit();
                //Return the data
                return $topTopicPostsData;
            } else {
                Log::error('Error fetching approved top topic posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved top topic posts: ' . $e->getMessage());
            return [];
        }
    }


    private function listPublicNoticePosts()
    {
        // Log for debugging
        Log::info('Fetching public notice posts...');

        $apiUrl = config('api.base_url') . '/public-notice'; // Adjust the URL to match the endpoint
        Log::info('API URL for Public Notice Posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch published posts
            $response = Http::get($apiUrl, [
                'per_page' => 6,    // Limit the result to 6 posts per page
                'status' => 'published',
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract the posts data
                $publicNoticePosts = $responseData['posts']['data'] ?? [];

                // If there are posts, log the result
                if (!empty($publicNoticePosts)) {
                    Log::info('Public notices fetched successfully', [
                        'post_count' => count($publicNoticePosts)
                    ]);
                }

                // print_r($publicNoticePosts);
                // exit();
                // Return the public notice posts
                return $publicNoticePosts;
            } else {
                // If the API call failed
                Log::error('Error fetching public notice: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            // Catch any exceptions
            Log::error('Error fetching public notice: ' . $e->getMessage());
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



    private function listCategories(Request $request)
    {
        Log::info('Fetching categories from external API...');

        // API URL for category listing
        $apiUrl = config('api.base_url') . '/categories/public';
        Log::info('Connecting to API URL for category listing', [
            'api_url' => $apiUrl,
        ]);

        // Prepare any query parameters (e.g., for sorting)
        $params = [
            'sort_by' => $request->get('sort_by', 'name'),
            'sort_order' => $request->get('sort_order', 'asc'),
        ];

        // Log the query parameters being sent
        Log::info('Sending query parameters', [
            'params' => $params,
        ]);

        // Make the GET request to the external API
        try {
            $response = Http::get($apiUrl, $params);

            // Log the response from the external API
            if ($response->successful()) {
                Log::info('Categories successfully fetched from external API', [
                    'response_data' => $response->json(),
                ]);

                // Extract categories from response (use 'data' key)
                return $response->json()['data'];
            } else {
                // Log the error response from the API
                Log::error('Error fetching categories from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred.',
                ]);

                return [];  // Return an empty array if API call fails
            }
        } catch (\Exception $e) {
            // Log the exception error with stack trace
            Log::error('API request failed with exception', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);

            return [];  // Return an empty array if there's an exception
        }
    }

    private function listCategories22(Request $request)
    {
        Log::info('Fetching categories from external API...');

        // API URL for category listing
        $apiUrl = config('api.base_url') . '/categories/public';
        Log::info('Connecting to API URL for category listing', [
            'api_url' => $apiUrl,
        ]);

        // Prepare any query parameters (e.g., for sorting)
        $params = [
            'sort_by' => $request->get('sort_by', 'name'),
            'sort_order' => $request->get('sort_order', 'asc'),
        ];

        // Log the query parameters being sent
        Log::info('Sending query parameters', [
            'params' => $params,
        ]);

        // Make the GET request to the external API
        try {
            $response = Http::get($apiUrl, $params);

            // Log the response from the external API
            if ($response->successful()) {
                Log::info('Categories successfully fetched from external API', [
                    'response_data' => $response->json(),
                ]);

                // Extract categories from response
                $categories = $response->json()['data'] ?? [];

                // print_r($categories);
                // exit();
                // Return categories directly
                return $categories;
            } else {
                // Log the error response from the API
                Log::error('Error fetching categories from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred.',
                ]);

                // Handle the error by returning an empty array or null
                return null;
            }
        } catch (\Exception $e) {
            // Log the exception error with stack trace
            Log::error('API request failed with exception', [
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);

            // Handle the error by returning an empty array or null
            return null;
        }
    }



    private function listLostAndFoundPostData()
    {
        // Log for debugging
        Log::info('Fetching Lost and Found published posts...');

        $apiUrl = config('api.base_url') . '/posts/lost-and-found';
        Log::info('API URL for Lost and Found published posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to the  endpoint to fetch the posts
            $response = Http::get($apiUrl, [
                'per_page' => 100,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                // Extract posts and pagination data from the response
                $responseData = $response->json();

                // Extract posts data and pagination info
                $LostAndFoundPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // print_r($LostAndFoundPostsData);
                // exit();

                // Return the data
                return [
                    'lostAndFoundPostsData' => $LostAndFoundPostsData,
                    'pagination' => $pagination
                ];
            } else {
                // If the response failed, handle the error
                Log::error('Error fetching lost and found published posts: ' . $response->status());
                return [
                    'lostAndFoundPostsData' => [],
                    'pagination' => []
                ];
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching lost and found published posts: ' . $e->getMessage());
            return [
                'lostAndFoundPostsData' => [],
                'pagination' => []
            ];
        }
    }

    private function listObituaryPosts()
    {
        // Log for debugging
        Log::info('Fetching Obituary published posts...');

        // Construct API URL
        $apiUrl = config('api.base_url') . '/posts/obituary';
        Log::info('API URL for fetching obituary posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to the endpoint to fetch posts
            $response = Http::get($apiUrl, [
                'per_page' => 100,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                // Parse the JSON response
                $responseData = $response->json();

                // Validate the structure of the response
                if (!isset($responseData['data']['posts'])) {
                    Log::error('Invalid API response structure: Missing "posts" key.');
                    return [
                        'obituaryPostsData' => [],
                        'pagination' => []
                    ];
                }

                // Extract posts data and pagination info
                $obituaryPostsData = $responseData['data']['posts'];
                $pagination = $responseData['data']['pagination'] ?? [];

                // print_r($obituaryPostsData);
                // exit();

                // Return the data
                return [
                    'obituaryPostsData' => $obituaryPostsData,
                    'pagination' => $pagination
                ];
            } else {
                // Log the HTTP status code for failed responses
                Log::error('Error fetching obituary posts: HTTP Status ' . $response->status());
                return [
                    'obituaryPostsData' => [],
                    'pagination' => []
                ];
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Exception fetching obituary posts: ' . $e->getMessage());
            return [
                'obituaryPostsData' => [],
                'pagination' => []
            ];
        }
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
