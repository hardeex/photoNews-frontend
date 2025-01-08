<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class StolenVehicle extends Controller
{
    public function create()
    {
        return view("vehicle.create");
    }

    public function submitPost(Request $request)
    {
        Log::info('Stolen Vehicle Post submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data for a stolen vehicle report
        $validated = $request->validate([
            'title' => 'required|string|max:255', // Title of the stolen vehicle post
            'slug' => 'required|string|max:255', // Slug for the post (used in URLs)
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Image of the stolen vehicle
            'vehicle_make' => 'required|string|max:255', // Vehicle make (e.g., Toyota, Honda)
            // 'vehicle_model' => 'required|string|max:255', // Vehicle model
            'vehicle_year' => 'required|integer|min:1900|max:' . (date('Y')), // Vehicle year (e.g., 1900-2024)
            'vehicle_color' => 'required|string|max:255', // Vehicle color
            'license_plate' => 'required|string|max:255', // Vehicle license plate
            'stolen_location' => 'required|string|max:1000', // Location where the vehicle was stolen
            'theft_date' => 'required|date', // Date and time of theft
            'content' => 'required|string|max:5000', // Detailed description of the theft
            'is_featured' => 'nullable|boolean', // Whether the post should be featured
            'is_draft' => 'nullable|boolean', // Whether the post is a draft
            'is_scheduled' => 'nullable|boolean', // Whether the post is scheduled for a future time
            'scheduled_time' => 'nullable|date|after:now', // Scheduled time for the post (if applicable)
            'allow_comments' => 'nullable|boolean', // Whether comments are allowed on the post
            'meta_title' => 'nullable|string|max:155', // Meta title for SEO
            'meta_description' => 'nullable|string|max:155', // Meta description for SEO
            'review_feedback' => 'nullable|string', // Review or feedback (if any)
        ]);

        // Get the JWT token from session (after login)
        $jwtToken = session('api_token');

        // If the JWT token is missing or expired, redirect to the login page
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // Prepare the form data for the stolen vehicle post
        $formData = [
            'title' => $validated['title'], // Title of the stolen vehicle post
            'slug' => $validated['slug'], // Slug for the post
            'featured_image' => $validated['featured_image'] ?? null, // Featured image (nullable)
            'vehicle_make' => $validated['vehicle_make'], // Make of the vehicle
            //'vehicle_model' => $validated['vehicle_model'], // Model of the vehicle
            'vehicle_year' => $validated['vehicle_year'], // Year of the vehicle
            'vehicle_color' => $validated['vehicle_color'], // Color of the vehicle
            'license_plate' => $validated['license_plate'], // License plate number
            'stolen_location' => $validated['stolen_location'], // Location where the vehicle was stolen
            'theft_date' => $validated['theft_date'], // Date of theft
            'content' => $validated['content'], // Description of the theft incident
            'is_featured' => $validated['is_featured'] ?? false, // Default to false if not provided
            'is_draft' => $validated['is_draft'] ?? false, // Default to false if not provided
            'is_scheduled' => $validated['is_scheduled'] ?? false, // Default to false if not provided
            'scheduled_time' => $validated['scheduled_time'] ?? null, // Scheduled post time (nullable)
            'allow_comments' => $validated['allow_comments'] ?? true, // Default to true if not provided
            'meta_title' => $validated['meta_title'] ?? null, // Meta title (nullable)
            'meta_description' => $validated['meta_description'] ?? null, // Meta description (nullable)
            'review_feedback' => $validated['review_feedback'] ?? null, // Review or feedback (nullable)
        ];

        Log::info('Request Payload:', $validated); // Before sending to the API

        // API URL for stolen vehicle post submission
        $apiUrl = config('api.base_url') . '/submit/stolen-vehicle';
        Log::info('Connecting to API URL for stolen vehicle post creation', [
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
                Log::info('Stolen Vehicle Post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Stolen Vehicle Post created successfully!');
            } else {
                // Handle API errors
                Log::error('Error returned from external API', [
                    'status_code' => $response->status(),
                    'error_message' => $response->json()['message'] ?? 'An error occurred creating stolen vehicle post.',
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
