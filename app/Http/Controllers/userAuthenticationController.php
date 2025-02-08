<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class userAuthenticationController extends Controller
{
    public function userRegister()
    {
        return view('user.register');
    }


    public function userRegisterSubmit(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'role' => 'nullable|string|in:user,admin',
        ]);

        // Prepare the data for the API request
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'password_confirmation' => $validated['password_confirmation'],
            'role' => $validated['role'] ?? 'user',
        ];

        // Build the full API URL dynamically using the config
        $apiUrl = config('api.base_url') . '/register';
        Log::info('Connecting to API URL: ' . $apiUrl);

        try {
            // Send the POST request to the external API
            $response = Http::post($apiUrl, $data);

            // Log the response for debugging purposes
            Log::info('API Response Status: ' . $response->status());
            Log::info('API Response Body: ' . $response->body());

            // Check if the API request was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Flash a success message to the session and redirect the user
                return redirect()->route('user.login')->with('success', $responseData['message']);
            } else {
                // Flash an error message to the session if the API failed
                Log::error('API registration failed with status code: ' . $response->status());
                Log::error('API Error Details: ' . $response->body());
                return back()->with('api_error', 'API registration failed. Please try again.');
            }
        } catch (\Exception $e) {
            // Log the exception and return an error message to the user
            Log::error('Exception occurred during API registration: ' . $e->getMessage());
            return back()->with('api_error', 'An error occurred while communicating with the registration service: ' . $e->getMessage());
        }
    }


    // login methods
    // public function userLogin()
    // {
    //     return view('user.login');
    // }


    public function userLogin()
    {
        // Check if the user is already logged in by verifying the session for a valid token
        // if (session()->has('api_token')) {
        //     // Redirect to the create-post page if the user is already logged in
        //     return redirect()->route('news.create-post');
        // }

        // If no token exists, show the login page
        return view('user.login');
    }


    // Handle the login submission and connect to the external API
    public function userLoginSubmit(Request $request)
    {
        // Validate the login form data
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        // Prepare the data to send to the API
        $data = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        // Build the full API URL dynamically using the config
        $apiUrl = config('api.base_url') . '/login';
        Log::info('Connecting to API URL: ' . $apiUrl);

        try {
            // Send the POST request to the external API
            $response = Http::post($apiUrl, $data);

            // Log the response for debugging purposes
            Log::info('API Response Status: ' . $response->status());
            Log::info('API Response Body: ' . $response->body());

            // Check if the API request was successful
            if ($response->successful()) {
                $responseData = $response->json();

                // Store the token and user data in the session
                if (isset($responseData['data']['authorization']['token'])) {
                    session([
                        'api_token' => $responseData['data']['authorization']['token'],
                        'user' => $responseData['data']['user'],
                    ]);

                    // Check if the user is an admin
                    if ($responseData['data']['user']['role'] == 'admin') {
                        // Redirect to the admin dashboard if the user is an admin
                        return redirect()->route('admin.dashboard')->with('success', 'Login successful! Welcome back, Admin.');
                    }
                } else {
                    // If no token returned, handle accordingly
                    return back()->withErrors(['login_error' => 'Authentication failed.']);
                }

                // Redirect to the user dashboard if the user is not an admin
                return redirect()->route('news.create-post')->with('success', 'Login successful! Welcome back.');
            } else {
                // If API login failed, show the error message
                return back()->withErrors(['login_error' => $response->json()['message'] ?? 'Login failed.']);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the API request
            Log::error('Exception occurred during API login: ' . $e->getMessage());
            return back()->withErrors(['login_error' => 'An error occurred while communicating with the login service: ' . $e->getMessage()]);
        }
    }

    public function userLogout(Request $request)
    {
        Log::info('The logout method is called...');
        // Get the token from the session
        $token = $request->session()->get('api_token');

        if ($token) {
            // Prepare the data to send to the API
            $data = [
                'token' => $token,  // You may need to send the token or any other data as required by your API
            ];

            // Build the full API URL dynamically using the config
            $apiUrl = config('api.base_url') . '/logout';
            Log::info('Connecting to API URL: ' . $apiUrl);

            try {
                // Send the POST request to the external API to log out
                $response = Http::withToken($token)->post($apiUrl, $data);

                // Log the response for debugging purposes
                Log::info('API Response Status: ' . $response->status());
                Log::info('API Response Body: ' . $response->body());

                // Check if the API request was successful
                if ($response->successful()) {
                    // Clear the session data
                    $request->session()->forget(['api_token', 'user']);
                    $request->session()->flush();

                    // Redirect to the login page or homepage
                    return redirect()->route('user.login')->with('success', 'You have successfully logged out.');
                } else {
                    // If the API logout failed, show an error message
                    return back()->withErrors(['logout_error' => 'Your token has expired. Kindly, login again']);
                }
            } catch (\Exception $e) {
                // Handle any exceptions that occur during the API request
                Log::error('Exception occurred during API logout: ' . $e->getMessage());
                return back()->withErrors(['logout_error' => 'An error occurred while communicating with the logout service: ' . $e->getMessage()]);
            }
        } else {
            // If no token is found, the user is already logged out
            return redirect()->route('user.login')->with('info', 'You are already logged out.');
        }
    }


    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    // End of the class
}
