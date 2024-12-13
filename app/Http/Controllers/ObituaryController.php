<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ObituaryController extends Controller
{
    public function createPost()
    {
        return view('obituary.create');
    }


    public function submitPost(Request $request)
    {
        Log::info('Obituary submission method is called...', [
            'request_data' => $request->all(),
        ]);

        // Validate the incoming form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:0',
            'date_of_birth' => 'required|date',
            'is_featured' => 'nullable|boolean',
            'is_draft' => 'nullable|boolean',
            'is_scheduled' => 'nullable|boolean',
            'scheduled_time' => 'nullable|date|after:now',
            'allow_comments' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:155',
            'meta_description' => 'nullable|string|max:155',
        ]);

        // Get the JWT token from the session
        $jwtToken = session('api_token');

        // Redirect to login if the JWT token is missing
        if (empty($jwtToken)) {
            Log::warning('JWT token missing or expired');
            return redirect()->route('user.login')->with('error', 'Please log in first');
        }

        // API URL for submission
        $apiUrl = config('api.base_url') . '/submit/obituary';
        Log::info('Connecting to API URL for missing person creation', [
            'api_url' => $apiUrl,
        ]);

        // Prepare form data
        $formData = [
            'title' => $validated['title'], // Title of the obituary
            'slug' => $validated['slug'], // Slug for URL
            'content' => $validated['content'], // Content/Details of the obituary
            'gender' => $validated['gender'], // Gender (male, female, or other)
            'age' => $validated['age'], // Age of the deceased
            'date_of_birth' => $validated['date_of_birth'], // Date of birth of the deceased
            'is_featured' => $validated['is_featured'] ?? false, // Whether the obituary is featured
            'is_draft' => $validated['is_draft'] ?? false, // Whether the obituary is saved as a draft
            'is_scheduled' => $validated['is_scheduled'] ?? false, // Whether the obituary is scheduled for future publication
            'scheduled_time' => $validated['scheduled_time'] ?? null, // Scheduled date & time for the obituary
            'allow_comments' => $validated['allow_comments'] ?? true, // Whether to allow comments on the obituary
            'meta_title' => $validated['meta_title'] ?? null, // Meta title for SEO
            'meta_description' => $validated['meta_description'] ?? null, // Meta description for SEO
            'featured_image' => $validated['featured_image'] ?? null, // Featured image (optional, might be uploaded)
            'review_feedback' => $validated['review_feedback'] ?? null, // Review feedback (only for admins)
        ];


        try {
            // API call with the form data and the image file if provided
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

            // Log the response and handle the outcome
            if ($response->successful()) {
                Log::info('Missing person post successfully created through external API', [
                    'response_data' => $response->json(),
                ]);

                return redirect()->back()->with('success', 'Missing person post created successfully!');
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
            return back()->withErrors(['error' => 'An error occurred while submitting the missing person post.']);
        }
    }
}
