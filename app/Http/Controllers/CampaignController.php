<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{
    //

    public function index(Request $request) {
        $campaigns = Campaign::get();

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaigns',
                'code' => Response::HTTP_OK,
            ],
            'data' => $campaigns,
        ], Response::HTTP_OK);
    }
}
