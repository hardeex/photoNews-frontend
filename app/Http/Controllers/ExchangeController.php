<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
}
