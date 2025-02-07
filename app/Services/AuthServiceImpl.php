<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function login(array $credentials): array
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new InvalidCredentialsException('Invalid credentials');
        }

        return $this->generateTokenResponse($user);
    }

    //TODO separate method to generate response/generate tokens
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
}
