<?php

namespace App\Services;

use App\Repositories\RefreshTokenRepository;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTServiceImpl implements JWTService
{

    public function __construct(
        private readonly RefreshTokenRepository $refreshTokenRepository
    )
    {
    }

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

    private function generateRefreshToken($user): string
    {
        return JWTAuth::customClaims([
            'exp' => now()->addMinutes(config('jwt.refresh_ttl'))
                ->timestamp])->fromUser($user);
    }

    private function generateAccessToken($user)
    {
        return JWTAuth::fromUser($user);
    }

    private function storeRefreshToken($refreshToken): void
    {
        $refreshArray = JWTAuth::setToken($refreshToken)->getPayload()->toArray();

        $this->refreshTokenRepository->create([
            'token' => $refreshToken,
            'created_at' => Carbon::createFromTimestamp($refreshArray['iat'])->toDateTimeString(),
            'expires_at' => Carbon::createFromTimestamp($refreshArray['exp'])->toDateTimeString(),
            'user_id' => $refreshArray['sub']
        ]);
    }

    //TODO methods to update refresh, delete refresh, check refresh
}
