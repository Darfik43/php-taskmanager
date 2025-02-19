<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::setToken($request['refreshToken'])->checkOrFail();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is not valid'], 400);
        }

        return $next($request);
    }
}
