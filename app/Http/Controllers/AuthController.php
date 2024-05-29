<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'me',]]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Validation Error',
                ],
                'data' => $validator->messages(),
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'code' => Response::HTTP_CREATED,
                    'message' => 'Registration Successful',
                ],
                'data' => null,
            ]);
        } else {
            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Registration Failed',
                ],
                'data' => null,
            ]);
        }
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Wrong credentials',
                ],
                'data' => null,
            ]);
        }

        return $this->respondWithToken($token, 'Success Login');
    }

    public function me()
    {
        return response()->json([
            'meta' => [
                'status' => 'success',
                'code' => Response::HTTP_OK,
                'message' => 'User Details Retrieved',
            ],
            'data' => auth()->user(),
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'meta' => [
                'status' => 'success',
                'code' => Response::HTTP_OK,
                'message' => 'Successfully logged out',
            ],
            'data' => null,
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(), 'Token Refreshed');
    }

    protected function respondWithToken($token, $message)
    {
        return response()->json([
            'meta' => [
                'status' => 'success',
                'code' => Response::HTTP_OK,
                'message' => $message,
            ],
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user_id' => auth()->user()->id,
            ],
        ]);
    }
}
