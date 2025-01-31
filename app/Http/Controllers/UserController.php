<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserMe;
use App\Models\CampaignTransaction;
use App\Http\Resources\UserProfile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $user = auth()->user();
        $userMe = new UserMe($user);

        return response()->json([
            'meta' => [
                'status' => 'success',
                'message' => 'success get user profile',
                'code' => Response::HTTP_OK,
            ],
            'data' => $userMe,
        ], Response::HTTP_OK);
    }

    public function profile(Request $request)
    {
        $user = auth()->user();

        $totalDonation = CampaignTransaction::where('user_id', $user->id)->sum('amount');

        $profile = new UserProfile($user);
        $profile->total_donation = $totalDonation;

        return response()->json([
            'meta' => [
                'status' => 'success',
                'message' => 'success get user profile',
                'code' => Response::HTTP_OK,
            ],
            'data' => $profile,
        ], Response::HTTP_OK);
    }
}
