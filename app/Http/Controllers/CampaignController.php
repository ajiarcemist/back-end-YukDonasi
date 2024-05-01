<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignListResource;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{
    //

    public function index(Request $request)
    {
        $campaigns = Campaign::get();

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

        $campaign = Campaign::findOrFail($id);

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaign',
                'code' => Response::HTTP_OK,
            ],
            'data' => new CampaignListResource($campaign),
        ], Response::HTTP_OK);
    }
}
