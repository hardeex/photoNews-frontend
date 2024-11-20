<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NewsPostController extends Controller
{

    public function createPost()
    {
        // $categories = Category::all()
        //     ->unique('name')
        //     ->sortBy('name')
        //     ->map(function ($category) {
        //         $category->name = ucwords(strtolower($category->name)); // Convert to title case
        //         return $category;
        //     });

        // $tags = Tag::all()
        //     ->unique('name')
        //     ->sortBy('name')
        //     ->map(function ($tag) {
        //         $tag->name = ucwords(strtolower($tag->name)); // Convert to title case
        //         return $tag;
        //     });

        return view('news.create-post', [
            // 'categories' => $categories,
            // 'tags' => $tags,
        ]);
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
    // public function createCategory()
    // {
    //     $jwtToken = session('api_token');
    //     if (empty($jwtToken)) {
    //         return redirect()->route('user.login')->with('error', 'Please log in first');
    //     }

    //     $apiUrl = config('api.base_url') . '/get-categories';
    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $jwtToken,
    //         ])->get($apiUrl);

    //         if ($response->successful()) {
    //             $categories = $response->json()['data'] ?? [];  // Use 'data' from the response
    //             Log::info('Fetched categories: ' . json_encode($categories));
    //         } else {
    //             $categories = [];
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching categories: ' . $e->getMessage());
    //         $categories = [];
    //     }

    //     return view('news.category', compact('categories'));
    // }


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
        $listCategoriesUrl = config('api.base_url') . '/list-categories';
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




    // End of the class
}
