<?php

namespace App\Http\Controllers;

use App\Models\CampaignTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class MidtransController extends Controller
{
    public function createPaymentLink($payload)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . env('MIDTRANS_KEY'),
        ])->post('https://api.sandbox.midtrans.com/v1/payment-links', [
            'transaction_details' => [
                'order_id' => $payload['transaction_number'],
                'gross_amount' => (int) $payload['amount'],
            ],
            'customer_details' => [
                'first_name' => $payload['name'],
                'email' => $payload['email'],
                'phone' => $payload['phone_number'],
                'notes' => 'Thank you for your purchase. Please follow the instructions to pay.'
            ],
            'currency' => 'IDR',
        ]);

        if ($response->failed()) {
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

    public function callback(Request $request)
    {
        // case credit card
        $orderId = explode('-', $request->order_id);
        $isSuccess = false;
        $campaignTransaction = CampaignTransaction::where('transaction_number', $orderId[0])->first();

        if (!$campaignTransaction) {
            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'message' => 'Transaction Not Found',
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                ],
                'data' => null,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($campaignTransaction->status == 'success') {
            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'message' => 'Transaction has been processed',
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                ],
                'data' => null,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($request->payment_type == 'credit_card') {
            if ($request->transaction_status == 'capture') {
                // berhasil
                $campaignTransaction->status = 'success';
                $campaignTransaction->callback = json_encode($request->all());
                $campaignTransaction->confirmed_date = \Carbon\Carbon::now();
                $isSuccess = true;
            }
        } else {
            if ($request->transaction_status == 'settlement') {
                $campaignTransaction->status = 'success';
                $campaignTransaction->callback = json_encode($request->all());
                $campaignTransaction->confirmed_date = \Carbon\Carbon::now();
                $isSuccess = true;
            }
        }

        if ($isSuccess) {
            $campaignTransaction->save();
        }

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
