<?php

namespace App\Services;

use App\Repositories\RefreshTokenRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTServiceImpl implements JWTService
{

    public function __construct(
       private readonly RefreshTokenRepository $refreshTokenRepository
    ){}

    public function generateTokens($user): array
    {
        $accessToken = $this->generateAccessToken($user);
        $refreshToken = $this->generateRefreshToken($user);
        $this->storeRefreshToken($refreshToken);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    private function generateTokenResponse($user): array
    {
        $accessToken = JWTAuth::fromUser($user);
        $ttl = config('jwt.ttl');
        $refreshToken = $this->generateRefreshToken($user);

        return [
            'user' => $user,
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => $ttl
        ];
    }

    private function generateRefreshToken($user): string
    {
        return JWTAuth::customClaims([
            'exp' => now()->addMinutes(config('jwt.refresh_ttl'))
                ->timestamp])->fromUser($user);
    }

    private function generateAccessToken($user)
    {
        return $refreshToken = JWTAuth::fromUser($user);
    }

    private function storeRefreshToken($refreshToken)
    {

    }

    //TODO methods to update refresh, delete refresh, check refresh
}
