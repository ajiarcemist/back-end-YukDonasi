<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignDetail;
use App\Http\Resources\CampaignListResource;
use App\Http\Resources\CampaignHistory;
use App\Models\Campaign;
use App\Models\CampaignTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{


    public function index(Request $request)
    {
        $campaigns = Campaign::with('donation')->withSum('donation', 'amount')->get();

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaigns',
                'code' => Response::HTTP_OK,
            ],
            'data' => CampaignListResource::collection($campaigns),
        ], Response::HTTP_OK);
    }
    public function detail(Request $request, $id)
    {

        $campaign = Campaign::with('donation')->withSum('donation', 'amount')->findOrFail($id);

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaign',
                'code' => Response::HTTP_OK,
            ],
            'data' => new CampaignDetail($campaign),
        ], Response::HTTP_OK);
    }

    public function history(Request $request, $userId)
    {
        $transactions = CampaignTransaction::where('user_id', $userId)->with('campaign')->get();

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaign history',
                'code' => Response::HTTP_OK,
            ],
            'data' => CampaignHistory::collection($transactions),
        ], Response::HTTP_OK);
    }
}
