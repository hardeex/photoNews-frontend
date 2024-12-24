<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


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


    public function createDedication()
    {
        return view("dedication.create");
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
}
