<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignTransactionDetail;
use App\Models\CampaignTransaction;
use App\Http\Resources\ValidationDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function makeDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'campaign_id' => 'required|exists:campaigns,id',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                    'code' => Response::HTTP_BAD_REQUEST,
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        $userId = Auth::id();

        $lastTransaction = CampaignTransaction::orderBy('id', 'desc')->first();
        $lastNumber = $lastTransaction ? (int)substr($lastTransaction->transaction_number, 4) : 0;
        $nextNumber = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
        $transactionNumber = 'INV-' . $nextNumber;

        $donationData = [
            'campaign_id' => $request->input('campaign_id'),
            'amount' => $request->input('amount'),
            'transaction_number' => $transactionNumber,
            'status' => 'pending',
            'confirmed_date' => null,
            'rejected_reason' => null,
            'user_id' => $userId,
        ];

        // Buat donasi baru
        $donation = CampaignTransaction::create($donationData);

        // Kirim respons JSON
        return response()->json([
            'meta' => [
                'status' => 'success',
                'message' => 'Donation successful',
                'code' => Response::HTTP_CREATED,
            ],
            'data' => new CampaignTransactionDetail($donation),
        ], Response::HTTP_CREATED);
    }
}
