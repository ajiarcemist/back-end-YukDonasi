<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignTransactionDetail;
use App\Models\CampaignTransaction;
use App\Http\Resources\ValidationDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class DonationController extends Controller
{
    public function makeDonation(Request $request)
    {

        $validator = Validator::make($request->all(), ValidationDonation::donationRules());


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


        $lastTransaction = CampaignTransaction::orderBy('id', 'desc')->first();
        $lastNumber = $lastTransaction ? (int)substr($lastTransaction->transaction_number, 4) : 0;
        $nextNumber = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
        $transactionNumber = 'INV-' . $nextNumber;


        $donationData = $request->all();
        $donationData['transaction_number'] = $transactionNumber;
        $donationData['status'] = $request->input('status', 'pending');
        $donationData['confirmed_date'] = $request->input('confirmed_date', null);
        $donation = CampaignTransaction::create($donationData);


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
