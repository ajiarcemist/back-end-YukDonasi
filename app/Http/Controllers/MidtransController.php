<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MidtransController extends Controller
{
    //

    public function createPaymentLink($payload) {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . env('MIDTRANS_KEY'),
        ])->post('https://api.sandbox.midtrans.com' . '/v1/payment-links', [
            'transaction_details' => [
                'order_id' => $payload['transaction_number'],
                'gross_amount' => (int) $payload['amount'],
            ],
            'currency' => 'IDR',
        ]);

        if($response->failed()) {
            return [
                'status' => 'failed',
                'data' => $response->json(),
            ];
        }

        // success
        
        return [
            'status' => 'success',
            'data' => $response->json(),
        ];
    }

 }
