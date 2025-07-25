<?php

namespace App\Authentication\Services;

use App\Authentication\Exceptions\InvalidTokenException;
use App\Authentication\Models\RefreshToken;
use App\Authentication\Repositories\RefreshTokenRepository;
use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;
use function App\Services\config;
use function App\Services\now;

class JWTServiceImpl implements JWTService
{

    public function __construct(
        private readonly RefreshTokenRepository $refreshTokenRepository
    )
    {
    }

    public function generateTokens(JWTSubject $user): array
    {
        $accessToken = $this->generateAccessToken($user);
        $refreshToken = $this->generateRefreshToken($user);

        $this->storeRefreshToken($refreshToken);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }

    public function refreshTokens(string $token, JWTSubject $user): array
    {
        if ($this->getRefreshTokenByToken($token) && $this->isRefreshExpired($token)) {
            $this->refreshTokenRepository->delete($token);
            return $this->generateTokens($user);
        } else {
            throw new InvalidTokenException("Token not found. Probably it was already used");
        }
    }

    private function generateRefreshToken(JWTSubject $user): string
    {
        return JWTAuth::customClaims([
            'exp' => now()->addMinutes(config('jwt.refresh_ttl'))
                ->timestamp])->fromUser($user);
    }

    private function generateAccessToken(JWTSubject $user): string
    {
        return JWTAuth::fromUser($user);
    }

    private function storeRefreshToken(string $refreshToken): void
    {
        $refreshArray = $this->getTokenPayloadAsArray($refreshToken);
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

    private function isRefreshExpired(string $token): bool
    {
        return $this->getTokenPayloadAsArray($token)['exp'] > now()->timestamp;
    }

    private function getTokenPayloadAsArray(string $token): array
    {
        return JWTAuth::setToken($token)->getPayload()->toArray();
    }
}
