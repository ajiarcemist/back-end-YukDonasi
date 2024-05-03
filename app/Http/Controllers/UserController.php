<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserMe;
use App\Http\Resources\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; // Added this line to import Response class

class UserController extends Controller
{
    public function me(Request $request, $id)
    {

        $campaign = User::findOrFail($id);

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaign',
                'code' => Response::HTTP_OK,
            ],
            'data' => new UserMe($campaign),
        ], Response::HTTP_OK);
    }
    public function profile(Request $request, $id)
    {

        $campaign = User::findOrFail($id);

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api campaign',
                'code' => Response::HTTP_OK,
            ],
            'data' => new UserProfile($campaign),
        ], Response::HTTP_OK);
    }
}
