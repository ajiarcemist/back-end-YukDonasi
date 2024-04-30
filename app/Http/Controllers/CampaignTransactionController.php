<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignTransactionList;
use App\Models\CampaignTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignTransactionController extends Controller
{
    public function index(Request $request)
    {
        $campaigntransaction = CampaignTransaction::get(); // Define $users array to avoid undefined variable error

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api user',
                'code' => Response::HTTP_OK,
            ],
            'data' => CampaignTransactionList::collection($campaigntransaction),
        ], Response::HTTP_OK);
    }
}
