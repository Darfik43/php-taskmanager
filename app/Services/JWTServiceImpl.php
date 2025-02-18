<?php

namespace App\Services;

use App\Exceptions\InvalidTokenException;
use App\Models\RefreshToken;
use App\Repositories\RefreshTokenRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Tymon\JWTAuth\Contracts\JWTSubject;
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

    /**
     * @throws InvalidTokenException
     */
    public function refreshTokens(string $token, JWTSubject $user): array
    {
        if ($this->getRefreshTokenByToken($token)) {
            $this->refreshTokenRepository->delete($token);
            return $this->generateTokens($user);
        } else {
            throw new InvalidTokenException("Token not found. Probably it was already used");
        }
    }

    private function generateRefreshToken($user): string
    {
        return JWTAuth::customClaims([
            'exp' => now()->addMinutes(config('jwt.refresh_ttl'))
                ->timestamp])->fromUser($user);
    }

    private function generateAccessToken($user): string
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

    /**
     * @throws InvalidTokenException
     */
    private function getRefreshTokenByToken(string $token): RefreshToken
    {
        return $this->refreshTokenRepository->findByToken($token)
            ?? throw new InvalidTokenException('Token not found');
    }
    //TODO isRefreshExpired method to compare and validate token(Isn't it validated here? $user = JWTAuth::parseToken()->authenticate();)
}
