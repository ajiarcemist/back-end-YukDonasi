<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'meta' => [
                        'status' => 'TOKEN_INVALID',
                        'code' => Response::HTTP_UNAUTHORIZED,
                        'message' => 'Token Invalid',
                    ],
                    'data' => null,
                ], Response::HTTP_UNAUTHORIZED);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'meta' => [
                        'status' => 'TOKEN_EXPIRED',
                        'code' => Response::HTTP_UNAUTHORIZED,
                        'message' => 'Token Expired',
                    ],
                    'data' => null,
                ], Response::HTTP_UNAUTHORIZED);
            } else if ($e instanceof JWTException) {
                return response()->json([
                    'meta' => [
                        'status' => 'TOKEN_NOT_FOUND',
                        'code' => Response::HTTP_UNAUTHORIZED,
                        'message' => 'Token not found',
                    ],
                    'data' => null,
                ], Response::HTTP_UNAUTHORIZED);
            }
        }

        return $next($request);
    }
}
