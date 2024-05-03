<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignTransactionDetail;
use App\Models\CampaignTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignTransactionController extends Controller
{
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
