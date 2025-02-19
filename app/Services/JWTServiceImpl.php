<?php

namespace App\Services;

use App\Exceptions\InvalidTokenException;
use App\Models\RefreshToken;
use App\Repositories\RefreshTokenRepository;
use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTServiceImpl implements JWTService
{

    public function __construct(
        private readonly RefreshTokenRepository $refreshTokenRepository,
        private readonly UserService $userService
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

    /**
     * @throws InvalidTokenException
     */
    public function refreshTokens(string $token): array
    {
        if (!$this->isRefreshExpired($token)) {
            $userId = $this->getRefreshTokenByToken($token)['user_id'];
            $this->refreshTokenRepository->delete($token);
            return $this->generateTokens(
                $this->userService->getUserById($userId)
            );
        } else {
            throw new InvalidTokenException("Token is expired");
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
        return $this->getTokenPayloadAsArray($token)['exp'] < now()->timestamp;
    }

    private function getTokenPayloadAsArray(string $token): array
    {
        return JWTAuth::setToken($token)->getPayload()->toArray();
    }
}
