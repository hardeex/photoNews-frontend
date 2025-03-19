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
        return view('editor.dashboard');
    }


    public function userDashboard()
    {
        return view('user.dashboard');
    }



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
        $caveatPostsData = $this->listCaveatPostsNews();

        // fetch pride of nigeria posts
        $listPrideOfNigeriaPostsData = $this->listPrideOfNigeriaPosts();



        // Fetch the approved music posts
        //$musicPostsData = $this->listApprovedMusicPosts();

        // Example: Get music posts
        $musicPostsData = $this->listPostsByCategoryName('Music');
        $localPostsData = $this->listPostsByCategoryName('Local');
        $internationalPostsData = $this->listPostsByCategoryName('International');

        // buisness posts category
        $businessPostsData = $this->listPostsByCategoryName('Business');

        // Fetch the approved local posts
        //$localPostsData = $this->listApprovedLocalPosts();

        // Fetch the approved local posts
        // $internationalPostsData = $this->listApprovedInternationalPosts();

        // Fetch the posts that are approved and event is true
        $topTopicPostsData = $this->listTopTopicPosts();


        // fetch the categories
        $categories = $this->listCategories($request);

        // Fetch public notice posts and total count
        $result = $this->listPublicNoticePosts();
        $publicNotice = $result['publicNoticePosts'] ?? [];
        // public notice
        //$publicNotice = $this->listPublicNoticePosts();

        // lost and found
        $lostAndFoundPostData = $this->listLostAndFoundPostData();

        // list obituary posts
        $listObituaryPostsData = $this->listObituaryPosts();

        // Fetch Missing posts
        // $missingPostsData = $this->listMissingPosts($request);

        // Fetch Wanted posts
        //$wantedPostsData = $this->listWantedPosts($request);

        // Fetch Missing posts data
        // Fetch Missing posts data
        $missingPostsData = $this->listMissingPosts($request);
        $wantedPostsData = $this->listWantedPosts($request);

        // Fix the data structure
        $missingPosts = $missingPostsData['posts']['posts'] ?? [];
        $wantedPosts = $wantedPostsData['posts']['posts'] ?? [];

        // Log::info('Missing Posts Data:', ['data' => $missingPostsData]);
        // Log::info('Wanted Posts Data:', ['data' => $wantedPostsData]);


        // Call the listPosts method to get the data
        $listRemembrancePostsData = $this->listRemembrancePosts($request);

        // fetch change of name
        $listChangeOfNamePostsData = $this->lisChangeOfNamePosts($request);

        $listCaveatPostsData = $this->listCaveatPosts();
        // Extract the posts data and pagination data
        $caveatPostsData = $listCaveatPostsData['caveatPostsData'] ?? [];
        $totalCaveatPostsData = $listCaveatPostsData['totalCaveatPosts'] ?? 0;

        // Fetch Birthday Posts Data using the private method
        $birthdayPostsData = $this->listBirthdayPostsData();

        // Get the total post count from the data
        $totalBirthdayPosts = count($birthdayPostsData);

        // Fetch Wedding Posts Data using the private method
        $weddingPostsData = $this->listWeddingPostsData();

        // Get the total post count from the data
        $totalWeddingPosts = count($weddingPostsData);


        // Fetch Child Dedication Posts Data using the private method
        $childDedicationPostsData = $this->listChildDedicationPostsData();

        // Get the total post count from the data
        $totalChildDedicationPosts = count($childDedicationPostsData);

        // Fetch Stolen Vehicle Posts Data using the private method
        $stolenVehiclePostsData = $this->listStolenVehiclePostsData();

        // Get the total post count from the data
        $totalStolenVehiclePosts = count($stolenVehiclePostsData);

        // Fetch categories using the private method
        $categoriesData = $this->getCategoriesData();

        // counting posts
        $totalPublishedPosts = $response['totalPublishedPosts'] ?? 0;
        $totalRemembrancePosts = $listRemembrancePostsData['totalRemembrancePosts'] ?? 0;

        $totalPrideOfNigeriaPosts = $listPrideOfNigeriaPosts['totalPrideOfNigeriaPosts'] ?? 0;

        // $totalPublicNoticePosts = $publicNotice['totalPublicNoticePosts'] ?? 0;
        $totalPublicNoticePosts = $result['totalPublicNoticePosts'] ?? 0;
        $totalLostAndFoundPosts = $lostAndFoundPostData['totalLostAndFoundPosts'] ?? 0;

        $totalObituaryPosts = $listObituaryPostsData['totalObituaryPosts'] ?? 0;
        $totalMissingPersonPosts = $missingPostsData['posts']['pagination']['total'] ?? 0;
        $totalWantedPersonPosts = $wantedPostsData['posts']['pagination']['total'] ?? 0;

        $totalChangeOfNamePosts = $listChangeOfNamePostsData['totalChangeOfNamePosts'] ?? 0;

        $totalCaveatPostsData = $listCaveatPostsData['totalCaveatPosts'] ?? 0;


        // handling the display of the youtube video

        $recentVideo = $this->getLiveVideos();



        // Pass both sets of posts data to the view
        return view('welcome', compact(
            'postsData',
            'pagination',

            'musicPostsData',
            'localPostsData',
            'breakingPostsData',
            // 'localPostsData',
            'internationalPostsData',
            'hotGistsPostsData',
            'eventsPostsData',
            'categories',
            'topTopicPostsData',
            'publicNotice',
            'caveatPostsData',
            'lostAndFoundPostData',
            'listObituaryPostsData',

            // 'missingPostsData',
            // 'wantedPostsData',

            'missingPosts',
            'wantedPosts',

            'listCaveatPostsData',

            'listRemembrancePostsData',
            'listChangeOfNamePostsData',
            'listPrideOfNigeriaPostsData',

            'birthdayPostsData',
            'totalBirthdayPosts',

            'weddingPostsData',
            'totalWeddingPosts',

            'childDedicationPostsData',
            'totalChildDedicationPosts',

            'stolenVehiclePostsData',
            'totalStolenVehiclePosts',

            'categoriesData',

            // counts
            'totalPublishedPosts',
            'totalRemembrancePosts',
            'totalPrideOfNigeriaPosts',

            'totalPublicNoticePosts',
            'totalLostAndFoundPosts',
            'totalObituaryPosts',

            'totalMissingPersonPosts',
            'totalWantedPersonPosts',

            'totalChangeOfNamePosts',


            'totalCaveatPostsData',

            'recentVideo'

        ));
    }


    // Private method to get live videos
    // private function getLiveVideos()
    // {
    //     $jwtToken = session('api_token'); // Retrieve the JWT token from the session
    //     Log::info('JWT Token:', ['token' => $jwtToken]); // Log the token

    //     if (empty($jwtToken)) {
    //         return []; // If the JWT token is not available, return an empty array
    //     }

    //     // Define the API endpoint to get live videos
    //     $apiUrl = config('api.base_url') . '/recent/youtube/video';
    //     Log::info('API URL:', ['url' => $apiUrl]); // Log the API URL

    //     try {
    //         // Make an API call to the /live/videos endpoint to fetch live videos
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $jwtToken,
    //         ])->get($apiUrl);

    //         // Check if the response was successful
    //         if ($response->successful()) {
    //             $responseData = $response->json();

    //             // Check if videos were returned successfully
    //             if (isset($responseData['video']) && count($responseData['video']) > 0) {
    //                 Log::info('Live videos fetched successfully.', ['videos' => $responseData['video']]);
    //                 return $responseData['video']; // Return the videos
    //             } else {
    //                 Log::error('No videos found.');
    //                 return []; // Return an empty array if no videos are found
    //             }
    //         } else {
    //             // Handle failure (e.g., unauthorized or bad request)
    //             if ($response->status() == 403) {
    //                 return redirect()->route('user.login')->with('error', 'Access denied. Please log in again.');
    //             }
    //             Log::error('API call failed', ['status' => $response->status(), 'response' => $response->json()]);
    //             return []; // Return an empty array if the API call fails
    //         }
    //     } catch (\Exception $e) {
    //         // Handle any errors that occur during the request
    //         Log::error('Error fetching live videos: ' . $e->getMessage());
    //         return []; // Return an empty array if an exception occurs
    //     }
    // }


    // Private method to get live videos
    private function getLiveVideos()
    {
        // Define the API endpoint to get live videos
        $apiUrl = config('api.base_url') . '/recent/youtube/video';
        Log::info('API URL:', ['url' => $apiUrl]); // Log the API URL

        try {
            // Make an API call to the endpoint without requiring authentication
            // Only use authentication if it's available
            $request = Http::timeout(10);

            // Add the token to the request if it exists
            if (session('api_token')) {
                $request = $request->withHeaders([
                    'Authorization' => 'Bearer ' . session('api_token'),
                ]);
            }

            $response = $request->get($apiUrl);

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
                Log::error('API call failed', ['status' => $response->status(), 'response' => $response->json()]);
                return []; // Return an empty array if the API call fails
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching live videos: ' . $e->getMessage());
            return []; // Return an empty array if an exception occurs
        }
    }



    private function getCategoriesData()
    {
        $apiUrl = config('api.base_url') . '/category-seeder';

        try {
            // Fetch categories data from the API
            $response = Http::get($apiUrl);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Check if the 'data' key exists in the response and contains categories
                if (isset($responseData) && is_array($responseData) && count($responseData) > 0) {
                    // Randomly pick 24 categories if there are enough categories
                    $randomCategories = (count($responseData) > 24)
                        ? collect($responseData)->random(24)->all()  // Pick 24 random categories
                        : $responseData;  // If there are less than 24, return all of them

                    return $randomCategories;
                } else {
                    Log::warning('No categories found or invalid data format in the API response.');
                    return [];
                }
            } else {
                Log::error('Error fetching categories. HTTP Status: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            // Log the exception error for debugging
            Log::error('Error in fetching categories: ' . $e->getMessage());
            return [];
        }
    }



    private function listPostsByCategoryName($categoryName)
    {
        $apiUrl = config('api.base_url') . '/category/posts';

        try {
            $response = Http::get($apiUrl, [
                'category_name' => $categoryName,
                'per_page' => 3
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                // Check if 'posts' key exists
                if (!isset($responseData['posts'])) {
                    Log::error("Posts key missing in response for category: {$categoryName}");
                    return ['posts' => [], 'pagination' => []];
                }

                $postsData = $responseData['posts']['data'] ?? [];
                $pagination = [
                    'current_page' => $responseData['posts']['current_page'] ?? 1,
                    'last_page' => $responseData['posts']['last_page'] ?? 1,
                    'total' => $responseData['posts']['total'] ?? 0,
                    'next_page_url' => $responseData['posts']['next_page_url'],
                    'prev_page_url' => $responseData['posts']['prev_page_url']
                ];

                return [
                    'posts' => $postsData,
                    'pagination' => $pagination
                ];
            }

            return ['posts' => [], 'pagination' => []];
        } catch (\Exception $e) {
            Log::error('Error fetching posts for category ' . $categoryName . ': ' . $e->getMessage());
            return ['posts' => [], 'pagination' => []];
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
                'per_page' => 3,
                'is_breaking' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data and pagination info
                $breakingPostsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // print_r($breakingPostsData);
                // exit();

                $totalBreakingPosts = $pagination['total'] ?? 0;
                Log::info('The total breaking posts count is' . $totalBreakingPosts);
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

                $totalHotGistPosts = $pagination['total'] ?? 0;
                Log::info('The Hot Gists' . $totalHotGistPosts);
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

                $totalEventsPosts = $pagination['total'] ?? 0;
                Log::info('The Events Total Posts: ' . $totalEventsPosts);

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


    private function listCaveatPostsNews()
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

                $totalCaveatPosts = $pagination['total'] ?? 0;
                Log::info('The total caveat posts:' . $totalCaveatPosts);

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

    private function listBirthdayPostsData()
    {
        // Log for debugging
        Log::info('Fetching Birthday approved posts...');

        $apiUrl = config('api.base_url') . '/posts/birthday';
        Log::info('API URL for approved Birthday posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'caveat' = true
            $response = Http::get($apiUrl, [
                'per_page' => 10,
                'event' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data
                $birthdayPostsData = $responseData['data']['posts'] ?? [];

                // Log total number of posts
                $totalBirthdayPosts = $responseData['data']['pagination']['total'] ?? 0;
                Log::info('Total Birthday Posts: ' . $totalBirthdayPosts);

                // Return the data
                return $birthdayPostsData;
            } else {
                Log::error('Error fetching approved Birthday posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved Birthday posts: ' . $e->getMessage());
            return [];
        }
    }


    private function listWeddingPostsData()
    {
        // Log for debugging
        Log::info('Fetching Wedding approved posts...');

        $apiUrl = config('api.base_url') . '/posts/wedding';
        Log::info('API URL for approved Wedding posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved posts with 'caveat' = true
            $response = Http::get($apiUrl, [
                'per_page' => 10,
                'event' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data
                $weddingPostsData = $responseData['data']['posts'] ?? [];

                // Log total number of posts
                $totalWeddingPosts = $responseData['data']['pagination']['total'] ?? 0;
                Log::info('Total Wedding Posts: ' . $totalWeddingPosts);

                // Return the data
                return $weddingPostsData;
            } else {
                Log::error('Error fetching approved Wedding posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved Wedding posts: ' . $e->getMessage());
            return [];
        }
    }


    private function listChildDedicationPostsData()
    {
        // Log for debugging
        Log::info('Fetching Child Dedication approved posts...');

        $apiUrl = config('api.base_url') . '/posts/dedication';
        Log::info('API URL for approved Child Dedication posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved child dedication posts
            $response = Http::get($apiUrl, [
                'per_page' => 10,
                'event' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data
                $childDedicationPostsData = $responseData['data']['posts'] ?? [];

                // Log total number of posts
                $totalChildDedicationPosts = $responseData['data']['pagination']['total'] ?? 0;
                Log::info('Total Child Dedication Posts: ' . $totalChildDedicationPosts);

                // Return the data
                return $childDedicationPostsData;
            } else {
                Log::error('Error fetching approved Child Dedication posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved Child Dedication posts: ' . $e->getMessage());
            return [];
        }
    }


    private function listStolenVehiclePostsData()
    {
        // Log for debugging
        Log::info('Fetching Stolen Vehicle approved posts...');

        $apiUrl = config('api.base_url') . '/posts/stolen-vehicle'; // API endpoint for stolen vehicle posts
        Log::info('API URL for approved Stolen Vehicle posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to fetch the approved stolen vehicle posts
            $response = Http::get($apiUrl, [
                'per_page' => 10,
                'event' => true,
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Extract posts data
                $stolenVehiclePostsData = $responseData['data']['posts'] ?? [];

                // Log total number of posts
                $totalStolenVehiclePosts = $responseData['data']['pagination']['total'] ?? 0;
                Log::info('Total Stolen Vehicle Posts: ' . $totalStolenVehiclePosts);

                // Return the data
                return $stolenVehiclePostsData;
            } else {
                Log::error('Error fetching approved Stolen Vehicle posts: ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching approved Stolen Vehicle posts: ' . $e->getMessage());
            return [];
        }
    }

    private function listPrideOfNigeriaPosts()
    {
        // Log for debugging
        Log::info('Fetching Pride of Nigeria approved posts...');

        // Construct API URL
        $apiUrl = config('api.base_url') . '/posts/pride-of-nigeria';
        Log::info('API URL for fetching Pride of Nigeria posts:', ['url' => $apiUrl]);

        try {
            // Make the API call to fetch Pride of Nigeria posts with the 'event' filter and pagination
            $response = Http::get($apiUrl, [
                'per_page' => 10, // Set the number of posts per page
                'event' => true,  // Assuming this filter is specific to Pride of Nigeria posts
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Validate the structure of the response to ensure 'posts' exists
                if (!isset($responseData['data']['posts'])) {
                    Log::error('Invalid API response structure: Missing "posts" key.');
                    return [];
                }

                // Extract posts data and pagination info
                $prideOfNigeriaPostsData = $responseData['data']['posts'];  // Data of Pride of Nigeria posts
                $pagination = $responseData['data']['pagination'] ?? [];   // Pagination data

                $totalPrideOfNigeriaPosts = $pagination['total'] ?? 0;
                Log::info('The total pride of nigeria posts: ' . $totalPrideOfNigeriaPosts);

                // Return the posts data
                return [
                    'prideOfNigeriaPostsData' => $prideOfNigeriaPostsData,
                    'pagination' => $pagination
                ];
            } else {
                // Log the error if the API request was unsuccessful
                Log::error('Error fetching Pride of Nigeria posts: HTTP Status ' . $response->status());
                return [];
            }
        } catch (\Exception $e) {
            // Catch any exceptions and log them
            Log::error('Exception fetching Pride of Nigeria posts: ' . $e->getMessage());
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

                $totalTopTopicPosts = $pagination['total'] ?? 0;
                Log::info('The top topic posts counts:' . $totalTopTopicPosts);

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

        $apiUrl = config('api.base_url') . '/public-notice';
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

                // Correctly access the total number of posts
                $totalPublicNoticePosts = $responseData['posts']['total'] ?? 0;

                Log::info('Total public notice posts:', ['total' => $totalPublicNoticePosts]);

                // print_r($publicNoticePosts);
                // exit();
                // Return both the public notice posts and the total count
                return [
                    'publicNoticePosts' => $publicNoticePosts,
                    'totalPublicNoticePosts' => $totalPublicNoticePosts
                ];
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





    private function listPublishedPosts()
    {
        // Log for debugging
        Log::info('Fetching published posts...');

        $apiUrl = config('api.base_url') . '/posts/published';
        Log::info('API URL for published posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to the /published/posts endpoint to fetch the 10 most recent posts
            $response = Http::get($apiUrl, [
                'per_page' => 12,
                'order' => 'desc',

            ]);

            // Check if the response was successful
            if ($response->successful()) {
                // Extract posts and pagination data from the response
                $responseData = $response->json();

                // Extract posts data and pagination info
                $postsData = $responseData['data']['posts'] ?? [];
                $pagination = $responseData['data']['pagination'] ?? [];

                // Get the total count of published posts from the pagination data
                $totalPublishedPosts = $pagination['total'] ?? 0;

                // Log the count of published posts for debugging purposes
                Log::info('Total Published Posts: ' . $totalPublishedPosts);

                // Return the data
                return [
                    'postsData' => $postsData,
                    'pagination' => $pagination,
                    'totalPublishedPosts' => $totalPublishedPosts
                ];
            } else {
                // If the response failed, handle the error
                Log::error('Error fetching published posts: ' . $response->status());
                return [
                    'postsData' => [],
                    'pagination' => [],
                    'totalPublishedPosts' => 0
                ];
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching published posts: ' . $e->getMessage());
            return [
                'postsData' => [],
                'pagination' => [],
                'totalPublishedPosts' => 0
            ];
        }
    }



    private function listCaveatPosts()
    {
        // Log for debugging
        Log::info('Fetching published Caveat posts...');

        $apiUrl = config('api.base_url') . '/posts/caveat/article';
        Log::info('API URL for caveat published posts:', ['url' => $apiUrl]);

        try {
            // Make an API call to the caveat endpoint to fetch the 12 most recent posts
            $response = Http::get($apiUrl, [
                'per_page' => 12,
                'order' => 'desc',
            ]);

            // Check if the response was successful
            if ($response->successful()) {
                // Extract posts and pagination data from the response
                $getCaveatPosts = $response->json();

                // Extract posts data and pagination info
                $caveatPostsData = $getCaveatPosts['data']['posts'] ?? [];
                $caveatPagination = $getCaveatPosts['data']['pagination'] ?? [];

                // Get the total count of published posts from the pagination data
                $totalCaveatPosts = $caveatPagination['total'] ?? 0;

                // print_r($caveatPostsData);
                // exit();

                // Log the count of published posts for debugging purposes
                Log::info('Total Caveat Published Posts: ' . $totalCaveatPosts);

                // Return the data
                return [
                    'caveatPostsData' => $caveatPostsData,
                    'caveatPagination' => $caveatPagination,
                    'totalCaveatPosts' => $totalCaveatPosts
                ];
            } else {
                // If the response failed, handle the error
                Log::error('Error fetching caveat published posts: ' . $response->status());
                return [
                    'caveatPostsData' => [],
                    'caveatPagination' => [],
                    'totalCaveatPosts' => 0
                ];
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            Log::error('Error fetching published posts: ' . $e->getMessage());
            return [
                'caveatPostsData' => [],
                'caveatPagination' => [],
                'totalCaveatPosts' => 0
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

                $totalLostAndFoundPosts = $pagination['total'] ?? 0;
                //Log::info('Total lost and found posts: ', $totalLostAndFoundPosts);

                // print_r($LostAndFoundPostsData);
                // exit();

                // print_r($totalLostAndFoundPosts);
                // exit();
                // Return the data
                return [
                    'lostAndFoundPostsData' => $LostAndFoundPostsData,
                    'pagination' => $pagination,
                    'totalLostAndFoundPosts' => $totalLostAndFoundPosts
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

                $totalObituaryPosts = $pagination['total'] ?? 0;
                Log::info('Total Obituary Posts' . $totalObituaryPosts);

                // print_r($obituaryPostsData);
                // exit();

                // Return the data
                return [
                    'obituaryPostsData' => $obituaryPostsData,
                    'pagination' => $pagination,
                    'totalObituaryPosts' => $totalObituaryPosts
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






    private function listMissingPosts(Request $request)
    {
        $apiUrl = config('api.base_url') . '/posts/missing-or-wanted';

        try {
            $response = Http::get($apiUrl, [
                'option' => 'missing',
                'per_page' => $request->get('per_page', 100),
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                return [
                    'posts' => $responseData['data'] ?? [],
                    'totalMissingPersonPosts' => $responseData['data']['pagination']['total'] ?? 0,
                ];
            }

            return ['posts' => [], 'totalMissingPersonPosts' => 0];
        } catch (\Exception $e) {
            Log::error('Exception fetching missing posts: ' . $e->getMessage());
            return ['posts' => [], 'totalMissingPersonPosts' => 0];
        }
    }

    private function listWantedPosts(Request $request)
    {
        $apiUrl = config('api.base_url') . '/posts/missing-or-wanted';

        try {
            $response = Http::get($apiUrl, [
                'option' => 'wanted',
                'per_page' => $request->get('per_page', 100),
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                return [
                    'posts' => $responseData['data'] ?? [],
                    'totalWantedPersonPosts' => $responseData['data']['pagination']['total'] ?? 0,
                ];
            }

            return ['posts' => [], 'totalWantedPersonPosts' => 0];
        } catch (\Exception $e) {
            Log::error('Exception fetching wanted posts: ' . $e->getMessage());
            return ['posts' => [], 'totalWantedPersonPosts' => 0];
        }
    }



    // List Remembrance Posts with filters and pagination
    private function listRemembrancePosts(Request $request)
    {
        // Log for debugging
        Log::info('Fetching Remembrance published posts...');

        // Construct API URL
        $apiUrl = config('api.base_url') . '/posts/remembrance';
        Log::info('API URL for fetching remembrance posts:', ['url' => $apiUrl]);

        try {
            // Prepare query parameters (pagination and filters)
            $queryParams = [
                'per_page' => $request->get('per_page', 10),  // Default to 10 posts per page if not provided
            ];

            // Add any additional filters to the query parameters
            if ($request->has('is_featured')) {
                $queryParams['is_featured'] = $request->input('is_featured');
            }

            if ($request->has('is_draft')) {
                $queryParams['is_draft'] = $request->input('is_draft');
            }

            if ($request->has('is_scheduled')) {
                $queryParams['is_scheduled'] = $request->input('is_scheduled');
            }

            if ($request->has('allow_comments')) {
                $queryParams['allow_comments'] = $request->input('allow_comments');
            }

            // Make the API call to fetch the posts
            $response = Http::get($apiUrl, $queryParams);

            // Check if the response was successful
            if ($response->successful()) {
                // Parse the JSON response
                $responseData = $response->json();

                // Validate the structure of the response
                if (!isset($responseData['data']['posts'])) {
                    Log::error('Invalid API response structure: Missing "posts" key.');
                    return [
                        'remembrancePostsData' => [],
                        'pagination' => []
                    ];
                }

                // Extract the posts data and pagination info
                $remembrancePostsData = $responseData['data']['posts'];
                $pagination = $responseData['data']['pagination'] ?? [];

                $totalRemembrancePosts = $pagination['total'] ?? 0;
                Log::info('The toatl remembrance posts: ' . $totalRemembrancePosts);
                // Return the data in the format expected by the frontend
                return [
                    'remembrancePostsData' => $remembrancePostsData,
                    'pagination' => $pagination,
                    'totalRemembrancePosts' => $totalRemembrancePosts,
                ];
            } else {
                // Log the HTTP status code for failed responses
                Log::error('Error fetching remembrance posts: HTTP Status ' . $response->status());
                return [
                    'remembrancePostsData' => [],
                    'pagination' => []
                ];
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Exception fetching remembrance posts: ' . $e->getMessage());
            return [
                'remembrancePostsData' => [],
                'pagination' => []
            ];
        }
    }


    private function lisChangeOfNamePosts(Request $request)
    {
        // Log for debugging
        Log::info('Fetching Change of Name published posts...');

        // Construct API URL
        $apiUrl = config('api.base_url') . '/posts/change-of-name';
        Log::info('API URL for fetching change of name posts:', ['url' => $apiUrl]);

        try {
            // Prepare query parameters (pagination and filters)
            $queryParams = [
                'per_page' => $request->get('per_page', 10),  // Default to 10 posts per page if not provided
            ];

            // Add any additional filters to the query parameters
            if ($request->has('is_featured')) {
                $queryParams['is_featured'] = $request->input('is_featured');
            }

            if ($request->has('is_draft')) {
                $queryParams['is_draft'] = $request->input('is_draft');
            }

            if ($request->has('is_scheduled')) {
                $queryParams['is_scheduled'] = $request->input('is_scheduled');
            }

            if ($request->has('allow_comments')) {
                $queryParams['allow_comments'] = $request->input('allow_comments');
            }

            // Make the API call to fetch the posts
            $response = Http::get($apiUrl, $queryParams);

            // Check if the response was successful
            if ($response->successful()) {
                // Parse the JSON response
                $responseData = $response->json();

                // Validate the structure of the response
                if (!isset($responseData['data']['posts'])) {
                    Log::error('Invalid API response structure: Missing "posts" key.');
                    return [
                        'changeOfNamePostsData' => [],
                        'pagination' => []
                    ];
                }

                // Extract the posts data and pagination info
                $changeOfNamePostsData = $responseData['data']['posts'];
                $pagination = $responseData['data']['pagination'] ?? [];

                $totalChangeOfNamePosts = $pagination['total'] ?? 0;
                Log::info('The toatl change of name counts: ' . $totalChangeOfNamePosts);
                // Return the data in the format expected by the frontend
                return [
                    'changeOfNamePostsData' => $changeOfNamePostsData,
                    'pagination' => $pagination,
                    'totalChangeOfNamePosts' => $totalChangeOfNamePosts,
                ];
            } else {
                // Log the HTTP status code for failed responses
                Log::error('Error fetching change of name posts: HTTP Status ' . $response->status());
                return [
                    'changeOfNamePostsData' => [],
                    'pagination' => []
                ];
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Exception fetching change of name posts: ' . $e->getMessage());
            return [
                'changeOfNamePostsData' => [],
                'pagination' => []
            ];
        }
    }


    public function newsletterSubscribe33(Request $request)
    {
        Log::info('Newsletter submission method is called...', [
            'request_data' => $request->all(), // Log the request data
        ]);

        // Validate the incoming request to ensure the email is valid
        $validated = $request->validate([
            'email' => 'required|string|email',
        ]);

        // API URL for the backend subscribe endpoint
        $apiUrl = config('api.base_url') . '/subscribe';
        Log::info('Connecting to API URL for post creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare the data to send to the external API (just the email)
        $formData = [
            'email' => $validated['email'],
        ];

        // Make the API request to the /subscribe endpoint
        try {
            // Use Laravel's HTTP client (Guzzle) to send the POST request
            $response = Http::post($apiUrl, $formData);

            // Check if the request was successful
            if ($response->successful()) {
                Log::info('Newsletter subscription successful', [
                    'response' => $response->json(),
                ]);
                return response()->json([
                    'message' => 'Successfully subscribed to the newsletter!',
                ], 201); // 201: Resource created
            } else {
                Log::error('Error during subscription API call', [
                    'error' => $response->body(),
                ]);
                return response()->json([
                    'message' => 'Failed to subscribe to the newsletter. Please try again later.',
                ], 500); // 500: Server error
            }
        } catch (\Exception $e) {
            // Catch any errors and log them
            Log::error('Exception during subscription API call', [
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'error' => $e->getMessage(),
            ], 500); // 500: Server error
        }
    }

    public function newsletterSubscribe(Request $request)
    {
        Log::info('Newsletter submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming request
        $validated = $request->validate([
            'email' => 'required|string|email',
        ]);

        $apiUrl = config('api.base_url') . '/subscribe';
        Log::info('Connecting to API URL for post creation', [
            'api_url' => $apiUrl,
        ]);

        $formData = [
            'email' => $validated['email'],
        ];

        try {
            $response = Http::post($apiUrl, $formData);

            // Check if the response indicates a duplicate email
            if (
                $response->status() === 409 ||
                str_contains(strtolower($response->body()), 'already') ||
                str_contains(strtolower($response->body()), 'duplicate')
            ) {
                return response()->json([
                    'message' => 'This email is already subscribed to our newsletter.',
                    'type' => 'info'  // Adding a type field to differentiate the response
                ], 409);  // Using 409 Conflict for duplicate resources
            }

            if ($response->successful()) {
                Log::info('Newsletter subscription successful', [
                    'response' => $response->json(),
                ]);
                return response()->json([
                    'message' => 'Successfully subscribed to the newsletter!',
                    'type' => 'success'
                ], 201);
            } else {
                Log::error('Error during subscription API call', [
                    'error' => $response->body(),
                ]);
                return response()->json([
                    'message' => 'Failed to subscribe to the newsletter. Please try again later.',
                    'type' => 'error'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception during subscription API call', [
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'error' => $e->getMessage(),
                'type' => 'error'
            ], 500);
        }
    }
}
