<?php

namespace App\Http\Controllers;

use App\Models\CampaignTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

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

    public function callback(Request $request) {

        // case credit card
        if($request->payment_type == 'credit_card') {
            if($request->transaction_status == 'capture') {
                // berhasil
                $campaignTransaction = CampaignTransaction::where('transaction_number', $request->order_id)->first();

                if($campaignTransaction) {
                    $campaignTransaction->status = 'success';
                    $campaignTransaction->callback = json_encode($request->all());
                    $campaignTransaction->confirmed_date = \Carbon\Carbon::now();
                }
            }
        }



        // case lainnya
        
        // kalo ada pembayaran lain tulis disini
        
        // end

        


        // last step
        $campaignTransaction->save();
        return response()->json([
            'meta' => [
                'status' => 'success',
                'message' => 'Callback Success',
                'code' => Response::HTTP_OK,
            ],
            'data' => null,
        ], Response::HTTP_OK);
    }

 }
