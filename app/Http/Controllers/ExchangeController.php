<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeController extends Controller
{
    public function showCurrency()
    {
        try {
            $response = Http::get('https://open.er-api.com/v6/latest/USD');
            $data = $response->json();

            $rates = [
                ['base' => 'USD', 'target' => 'EUR', 'value' => $data['rates']['EUR'] ?? 0.92],
                ['base' => 'USD', 'target' => 'GBP', 'value' => $data['rates']['GBP'] ?? 0.79],
                ['base' => 'USD', 'target' => 'JPY', 'value' => $data['rates']['JPY'] ?? 134.56],
                ['base' => 'USD', 'target' => 'CAD', 'value' => $data['rates']['CAD'] ?? 1.35],
                ['base' => 'USD', 'target' => 'AUD', 'value' => $data['rates']['AUD'] ?? 1.48],
                ['base' => 'USD', 'target' => 'CHF', 'value' => $data['rates']['CHF'] ?? 0.88],
                ['base' => 'USD', 'target' => 'CNY', 'value' => $data['rates']['CNY'] ?? 7.24],
                ['base' => 'USD', 'target' => 'INR', 'value' => $data['rates']['INR'] ?? 83.45],
                ['base' => 'USD', 'target' => 'NGN', 'value' => $data['rates']['NGN'] ?? 1625.3],
            ];
        } catch (\Exception $e) {
            $rates = [
                ['base' => 'USD', 'target' => 'EUR', 'value' => 0.92],
                ['base' => 'USD', 'target' => 'GBP', 'value' => 0.79],
                ['base' => 'USD', 'target' => 'JPY', 'value' => 134.56],
                ['base' => 'USD', 'target' => 'CAD', 'value' => 1.35],
                ['base' => 'USD', 'target' => 'AUD', 'value' => 1.48],
                ['base' => 'USD', 'target' => 'CHF', 'value' => 0.88],
                ['base' => 'USD', 'target' => 'CNY', 'value' => 7.24],
                ['base' => 'USD', 'target' => 'INR', 'value' => 83.45],
                ['base' => 'USD', 'target' => 'NGN', 'value' => 1625.3],
            ];
        }

        return view('exchange-rate.exchange-rate', compact('rates'));
    }




// public function startPayment(Request $request, $post_type)
// {
//     $token = session('api_token');

//     if (!$token) {
//         return redirect()->route('login')->with('error', 'Authentication token missing.');
//     }

//     try {
//         $response = Http::withHeaders([
//             'Authorization' => 'Bearer ' . $token,
//             'Accept' => 'application/json',
//         ])->post(config('api.base_url') . "/payments/initiate/{$post_type}");

//         if ($response->successful()) {
//             $data = $response->json();
//             if (isset($data['data']['payment_url'])) {
//                 return redirect()->away($data['data']['payment_url']);
//             }
//         }

//         return redirect()->back()->with('error', 'Failed to initiate payment.');
//     } catch (\Exception $e) {
//         Log::error('Error initiating payment', ['error' => $e->getMessage()]);
//         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
//     }
// }


public function startPayment(Request $request, $post_type)
    {
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Authentication token missing.');
        }

        // Map post types to frontend routes
        $postTypeRoutes = [
            'birthday' => '/create/birthday',
            'caveat' => '/create/caveat',
            'change_of_name' => '/create/change-of-name',
            'dedication' => '/create/dedication',
            'lost_and_found' => '/create/lost-and-found',
            'missing_and_wanted' => '/create/missing-and-wanted',
            'obituary' => '/create/obituary',
            'public_notice' => '/create/public-notice',
            'remembrance' => '/create/remembrance',
            'stolen_vehicle' => '/create/stolen-vehicle',
            'wedding' => '/create/wedding',
        ];

        // Set return_url based on post type
        $returnUrl = config('app.url') . ($postTypeRoutes[$post_type] ?? '/');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->post(config('api.base_url') . "/payments/initiate/{$post_type}", [
                'return_url' => $returnUrl,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['data']['payment_url'])) {
                    return redirect()->away($data['data']['payment_url']);
                }
            }

            return redirect()->route('payment.initiate')->with('error', 'Failed to initiate payment.');
        } catch (\Exception $e) {
            Log::error('Error initiating payment', ['error' => $e->getMessage()]);
            return redirect()->route('payment.initiate')->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function createPost(Request $request, $post_type)
    {
        try {
            Log::info("Starting createPost for {$post_type}");

            // Map post types to view names
            $postTypeViews = [
                'birthday' => 'birthday.create',
                'caveat' => 'caveat.create',
                'change_of_name' => 'change-of-name.create',
                'dedication' => 'dedication.create',
                'lost_and_found' => 'lost-and-found.create',
                'missing_and_wanted' => 'missing-and-wanted.create',
                'obituary' => 'obituary.create',
                'public_notice' => 'public-notice.create',
                'remembrance' => 'remembrance.create',
                'stolen_vehicle' => 'stolen-vehicle.create',
                'wedding' => 'wedding.create',
            ];

            // Handle payment status from query parameters
            if ($request->query('status') === 'success' && $request->query('payment_id')) {
                Log::info('User redirected with successful payment', [
                    'post_type' => $post_type,
                    'payment_id' => $request->query('payment_id'),
                ]);
                return view($postTypeViews[$post_type] ?? 'errors.404', [
                    'payment_id' => $request->query('payment_id'),
                ]);
            } elseif ($request->query('status') === 'failed') {
                Log::warning('Payment failed as per query parameter', [
                    'post_type' => $post_type,
                    'payment_id' => $request->query('payment_id'),
                ]);
                return redirect()->route('payment.initiate')->with('error', 'Payment failed. Please try again.');
            }

            $token = session('api_token');
            if (!$token) {
                Log::warning('JWT token missing from session');
                return redirect()->route('login')->with('error', 'Authentication token missing.');
            }

            Log::info('Checking payment status', ['post_type' => $post_type]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get(config('api.base_url') . "/payment/check/{$post_type}");

            Log::info('Payment check response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if (!$response->successful()) {
                Log::error('Payment check failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return redirect()->route('payment.initiate')->with('error', 'Failed to verify payment status.');
            }

            $data = $response->json();

            if (isset($data['status'], $data['data']['has_paid']) && 
                $data['status'] === 'success' && $data['data']['has_paid']) {
                Log::info('User has paid', [
                    'post_type' => $post_type,
                    'payment_id' => $data['data']['payment_id'] ?? null,
                ]);
                return view($postTypeViews[$post_type] ?? 'errors.404', [
                    'payment_id' => $data['data']['payment_id'],
                ]);
            }

            Log::warning('Payment not verified', ['post_type' => $post_type]);
            return redirect()->route('payment.initiate')->with('error', "Please complete payment to create a {$post_type} post.");
        } catch (\Exception $e) {
            Log::error('Error in createPost', [
                'post_type' => $post_type,
                'error' => $e->getMessage(),
            ]);
            return redirect()->route('payment.initiate')->with('error', 'Failed to verify payment. Please try again.');
        }
    }

}
