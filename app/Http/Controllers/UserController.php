<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserListResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; // Added this line to import Response class

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::get(); // Define $users array to avoid undefined variable error

        return response([
            'meta' => [
                'status' => 'success',
                'message' => 'success get api user',
                'code' => Response::HTTP_OK,
            ],
            'data' => UserListResource::collection($users),
        ], Response::HTTP_OK);
    }
}
