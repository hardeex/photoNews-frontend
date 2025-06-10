<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

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

                   // Save token and user in session
    session([
        'api_token' => $responseData['token'] ?? null,
        'user' => $responseData['user'] ?? null,
    ]);


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


    public function userLogin()
    {
        

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

                    // Get user role
                    $userRole = $responseData['data']['user']['role'];

                    // Redirect based on user role
                    if ($userRole == 'admin') {
                        return redirect()->route('admin.dashboard')->with('success', 'Login successful! Welcome back, Admin.');
                    }

                    if ($userRole == 'editor') {
                        return redirect()->route('editor.dashboard')->with('success', 'Login successful! Welcome back, Editor.');
                    }

                    // If the user is neither an admin nor an editor, redirect to the user dashboard
                    return redirect()->route('user.dashboard')->with('success', 'Login successful! Welcome back.');
                } else {
                    // If no token returned, handle accordingly
                    return back()->withErrors(['login_error' => 'Authentication failed.']);
                }
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

    public function forgotPassword()
    {
        return view('user.forgot-password');
    }


    public function adminDashboard(Request $request)
    {
         $token = $request->session()->get('api_token');
         if(!$token){
            return redirect()->route('user.login');
         }

        return view('admin.dashboard');
    }



    // Handle forgot password submission
    public function forgotPasswordSubmit(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
        ]);

        $apiUrl = config('api.base_url') . '/forgot-password';
        Log::info('Connecting to API URL: ' . $apiUrl);

        try {
            $response = Http::post($apiUrl, ['email' => $validated['email']]);

            Log::info('API Response Status: ' . $response->status());
            Log::info('API Response Body: ' . $response->body());

            if ($response->successful()) {
                $responseData = $response->json();
                // Session::put('email');
                return redirect()->route('user.login')->with('success', $responseData['message']);
            } else {
                return back()->withErrors(['forgot_error' => $response->json()['message'] ?? 'Failed to send reset link.']);
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred during forgot password: ' . $e->getMessage());
            return back()->withErrors(['forgot_error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    // Show reset password form
    public function resetPassword(Request $request)
    {
        return view('user.reset-password', [
            'token' => $request->query('token'),
            'email' => $request->query('email'),
        ]);
    }

    // Handle reset password submission
    public function resetPasswordSubmit(Request $request)
{
    Log::info('The Reset Password method is called');
    Log::debug('[Reset Password] Validating input...', $request->all());

    // Step 1: Validate the request
    $validated = $request->validate([
        'email' => 'required|string|email',
        'token' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);

    Log::debug('[Reset Password] Validation passed');
    $apiUrl = config('api.base_url') . '/reset-password';
    Log::info('[Reset Password] API URL: ' . $apiUrl);
    Log::debug('[Reset Password] Request Payload:', $validated);

    try {
          Log::debug('[Reset Password] Sending request to API');
        // Step 2: Call the external API
        //$response = Http::post($apiUrl, $validated);
        $response = Http::post($apiUrl, [
    'email' => $validated['email'],
    'token' => $validated['token'],
    'password' => $validated['password'],
    'password_confirmation' => $request->input('password_confirmation'),
]);

        Log::debug('[Reset Password] Got response');

        Log::info('[Reset Password] API Response Status: ' . $response->status());
        Log::debug('[Reset Password] API Raw Response: ' . $response->body());

        if ($response->successful()) {
            $responseData = $response->json();
            Log::info('[Reset Password] Success: ' . ($responseData['message'] ?? 'No message provided.'));
            return redirect()->route('user.login')->with('success', $responseData['message']);
        } else {
            $error = $response->json()['message'] ?? 'Failed to reset password.';
            Log::warning('[Reset Password] API Error: ' . $error);
            return back()->withErrors(['reset_error' => $error]);
        }
    } catch (\Exception $e) {
         Log::error('[Reset Password] Exception caught: ' . $e->getMessage());
        // Step 3: Catch and log exceptions
        Log::error('[Reset Password] Exception: ' . $e->getMessage());
        return back()->withErrors(['reset_error' => 'An error occurred: ' . $e->getMessage()]);
    }
}




   // Handle editor application submission
    public function requestEditorSubmit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'experience' => 'required|string|in:none,beginner,intermediate,advanced,professional',
            'category' => 'required|string',
            'motivation' => 'required|string',
            'sample' => 'required|string',
            'terms' => 'required|accepted',
        ]);

        $apiUrl = config('api.base_url') . '/request-editor';
        Log::info('Connecting to API URL: ' . $apiUrl);

        try {
            $response = Http::post($apiUrl, $validated);

            // Log::info('API Response Status: ' . $response->status());
            // Log::info('API Response Body: ' . $response->body());

            if ($response->successful()) {
                $responseData = $response->json();
                return redirect()->route('user.login')->with('success', $responseData['message']);
            } else {
                return back()->withErrors(['editor_error' => $response->json()['message'] ?? 'Failed to submit application.']);
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred during editor application: ' . $e->getMessage());
            return back()->withErrors(['editor_error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }



 public function manageEditor(Request $request)
{
    $apiUrl = config('api.base_url') . '/list-editors';
    Log::info('[Manage Editor] Sending request to API:', ['url' => $apiUrl]);

    try {
        $token = session('api_token');
        Log::debug('[Manage Editor] Using API token:', ['token' => $token]);

        $response = Http::withToken($token)->get($apiUrl);

        Log::info('[Manage Editor] API Response Status: ' . $response->status());

        if ($response->successful()) {
            $editors = $response->json()['editors'] ?? [];

            Log::debug('[Manage Editor] Editors fetched:', [
                'count' => count($editors),
                'editors_sample' => array_slice($editors, 0, 3) // Only show first 3 for brevity
            ]);

            return view('admin.manage-editor', compact('editors'));
        } else {
            Log::warning('[Manage Editor] Failed to fetch editors.', [
                'response_status' => $response->status(),
                'response_body' => $response->body()
            ]);

            return back()->withErrors(['error' => 'Failed to load editors.']);
        }
    } catch (\Exception $e) {
        Log::error('[Manage Editor] Exception occurred: ' . $e->getMessage(), [
            'trace' => config('app.debug') ? $e->getTraceAsString() : 'Trace hidden in production'
        ]);

        return back()->withErrors(['error' => 'Error connecting to the editor API.']);
    }
}


public function approveEditor(Request $request, $id)
{
    $url = config('api.base_url') . "/approve-editor/{$id}";

    try {
        $response = Http::withToken(session('api_token'))->post($url);

        if ($response->successful()) {
            return back()->with('success', 'Editor approved successfully.');
        }

        return back()->withErrors(['error' => $response->json()['message'] ?? 'Approval failed.']);
    } catch (\Exception $e) {
        Log::error('Approval failed: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Approval failed.']);
    }
}

public function rejectEditor(Request $request, $id)
{
    $validated = $request->validate([
        'reason' => 'required|string|max:255'
    ]);

    $url = config('api.base_url') . "/reject-editor/{$id}";

    try {
        $response = Http::withToken(session('api_token'))->post($url, [
            'reason' => $validated['reason']
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Editor rejected successfully.');
        }

        return back()->withErrors(['error' => $response->json()['message'] ?? 'Rejection failed.']);
    } catch (\Exception $e) {
        Log::error('Rejection failed: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Rejection failed.']);
    }
}





    // End of the class
}
