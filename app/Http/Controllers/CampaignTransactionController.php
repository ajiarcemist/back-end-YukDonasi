<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignTransactionDetail;
use App\Http\Resources\CampaignTransactionList;
use App\Models\CampaignTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignTransactionController extends Controller
{
    public function index(Request $request, $userId)
    {
        $transactions = CampaignTransaction::where('user_id', $userId)->with('campaign')->get();

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaign history',
                'code' => Response::HTTP_OK,
            ],
            'data' => CampaignTransactionList::collection($transactions),
        ], Response::HTTP_OK);
    }

    public function detail(Request $request, $id)
    {

        $campaignTransaction = CampaignTransaction::findOrFail($id);

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api user',
                'code' => Response::HTTP_OK,
            ],
            'data' => new CampaignTransactionDetail($campaignTransaction),
        ], Response::HTTP_OK);
    }
}
