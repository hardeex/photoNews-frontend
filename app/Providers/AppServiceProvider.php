<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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
                $response = Http::get('https://open.er-api.com/v6/latest/USD');
                $data = $response->json();
                return [
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
                return []; // fallback data if API fails and cache is empty
            }
        });

        $view->with('exchangeRates', $rates);
    });
}


}
