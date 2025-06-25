<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $rates = Cache::remember('exchange_rates_usd', 60 * 60, function () {
                try {
                    //Log::info('Attempting to fetch exchange rates from API');
                    $response = Http::timeout(10)->get('https://open.er-api.com/v6/latest/USD');
                    $data = $response->json();

                    // Log the API response
                   // Log::info('Exchange Rate API Response:', ['data' => $data]);

                    // Check if the API response is valid
                    if (!isset($data['rates'])) {
                       // Log::warning('Invalid API response, missing rates:', ['data' => $data]);
                        throw new \Exception('Invalid API response');
                    }

                    $rates = [
                        ['base' => 'USD', 'target' => 'EUR', 'value' => $data['rates']['EUR'] ?? 0.870033],
                        ['base' => 'USD', 'target' => 'GBP', 'value' => $data['rates']['GBP'] ?? 0.743127],
                        ['base' => 'USD', 'target' => 'JPY', 'value' => $data['rates']['JPY'] ?? 145.333759],
                        ['base' => 'USD', 'target' => 'CAD', 'value' => $data['rates']['CAD'] ?? 1.370399],
                        ['base' => 'USD', 'target' => 'AUD', 'value' => $data['rates']['AUD'] ?? 1.544176],
                        ['base' => 'USD', 'target' => 'CHF', 'value' => $data['rates']['CHF'] ?? 0.817212],
                        ['base' => 'USD', 'target' => 'CNY', 'value' => $data['rates']['CNY'] ?? 7.187916],
                        ['base' => 'USD', 'target' => 'INR', 'value' => $data['rates']['INR'] ?? 86.804405],
                        ['base' => 'USD', 'target' => 'NGN', 'value' => $data['rates']['NGN'] ?? 1548.381581],
                    ];

                    //Log::info('Exchange Rates Prepared:', ['rates' => $rates]);
                    return $rates;
                } catch (\Exception $e) {
                   // Log::error('Exchange Rate API Error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

                    // Return fallback rates
                    $fallbackRates = [
                        ['base' => 'USD', 'target' => 'EUR', 'value' => 0.870033],
                        ['base' => 'USD', 'target' => 'GBP', 'value' => 0.743127],
                        ['base' => 'USD', 'target' => 'JPY', 'value' => 145.333759],
                        ['base' => 'USD', 'target' => 'CAD', 'value' => 1.370399],
                        ['base' => 'USD', 'target' => 'AUD', 'value' => 1.544176],
                        ['base' => 'USD', 'target' => 'CHF', 'value' => 0.817212],
                        ['base' => 'USD', 'target' => 'CNY', 'value' => 7.187916],
                        ['base' => 'USD', 'target' => 'INR', 'value' => 86.804405],
                        ['base' => 'USD', 'target' => 'NGN', 'value' => 1548.381581],
                    ];

                   // Log::info('Using Fallback Exchange Rates:', ['rates' => $fallbackRates]);
                    return $fallbackRates;
                }
            });

            // Check if rates is empty (from cache) and force refresh if so
            if (empty($rates)) {
               // Log::warning('Empty rates detected in cache, clearing cache and retrying');
                Cache::forget('exchange_rates_usd');
                $rates = Cache::remember('exchange_rates_usd', 60 * 60, function () {
                    // Repeat the same try-catch logic as above
                    try {
                        //Log::info('Retrying API fetch after clearing cache');
                        $response = Http::timeout(10)->get('https://open.er-api.com/v6/latest/USD');
                        $data = $response->json();

                       // Log::info('Exchange Rate API Response (Retry):', ['data' => $data]);

                        if (!isset($data['rates'])) {
                           // Log::warning('Invalid API response (Retry), missing rates:', ['data' => $data]);
                            throw new \Exception('Invalid API response');
                        }

                        $rates = [
                            ['base' => 'USD', 'target' => 'EUR', 'value' => $data['rates']['EUR'] ?? 0.870033],
                            ['base' => 'USD', 'target' => 'GBP', 'value' => $data['rates']['GBP'] ?? 0.743127],
                            ['base' => 'USD', 'target' => 'JPY', 'value' => $data['rates']['JPY'] ?? 145.333759],
                            ['base' => 'USD', 'target' => 'CAD', 'value' => $data['rates']['CAD'] ?? 1.370399],
                            ['base' => 'USD', 'target' => 'AUD', 'value' => $data['rates']['AUD'] ?? 1.544176],
                            ['base' => 'USD', 'target' => 'CHF', 'value' => $data['rates']['CHF'] ?? 0.817212],
                            ['base' => 'USD', 'target' => 'CNY', 'value' => $data['rates']['CNY'] ?? 7.187916],
                            ['base' => 'USD', 'target' => 'INR', 'value' => $data['rates']['INR'] ?? 86.804405],
                            ['base' => 'USD', 'target' => 'NGN', 'value' => $data['rates']['NGN'] ?? 1548.381581],
                        ];

                        //Log::info('Exchange Rates Prepared (Retry):', ['rates' => $rates]);
                        return $rates;
                    } catch (\Exception $e) {
                        //Log::error('Exchange Rate API Error (Retry):', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

                        $fallbackRates = [
                            ['base' => 'USD', 'target' => 'EUR', 'value' => 0.870033],
                            ['base' => 'USD', 'target' => 'GBP', 'value' => 0.743127],
                            ['base' => 'USD', 'target' => 'JPY', 'value' => 145.333759],
                            ['base' => 'USD', 'target' => 'CAD', 'value' => 1.370399],
                            ['base' => 'USD', 'target' => 'AUD', 'value' => 1.544176],
                            ['base' => 'USD', 'target' => 'CHF', 'value' => 0.817212],
                            ['base' => 'USD', 'target' => 'CNY', 'value' => 7.187916],
                            ['base' => 'USD', 'target' => 'INR', 'value' => 86.804405],
                            ['base' => 'USD', 'target' => 'NGN', 'value' => 1548.381581],
                        ];

                       // Log::info('Using Fallback Exchange Rates (Retry):', ['rates' => $fallbackRates]);
                        return $fallbackRates;
                    }
                });
            }

            //Log::info('Exchange Rates Passed to View:', ['rates' => $rates]);
            $view->with('exchangeRates', $rates);
        });
    }
}