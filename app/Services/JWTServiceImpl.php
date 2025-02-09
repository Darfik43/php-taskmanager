<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class JWTServiceImpl implements JWTService
{

    public function generateTokens($user): array
    {
        $accessToken =
    }

    private function generateTokenResponse($user): array
    {
        $accessToken = JWTAuth::fromUser($user);
        $ttl = config('jwt.ttl');
        $refreshToken = $this->generateRefreshResponse($user);

        return [
            'user' => $user,
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => $ttl
        ];
    }

    private function generateRefreshResponse($user): string
    {
        return JWTAuth::customClaims([
            'exp' => now()->addMinutes(config('jwt.refresh_ttl'))
                ->timestamp])->fromUser($user);
    }

    private function generateAccessToken($user)
    {
        return $refreshToken = JWTAuth::fromUser($user);
    }

    private function storeRefreshToken()
    {

    }

}
