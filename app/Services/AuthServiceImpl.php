<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\InvalidTokenException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly JWTService $jwtService
    ) {}

    public function login(array $credentials): array
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new InvalidCredentialsException('Invalid credentials');
        }

        return $this->jwtService->generateTokens($user);
    }

    public function refreshTokens(string $token): array
    {
        try {
            $user = JWTAuth::setToken($token)->authenticate();

            return $this->jwtService->refreshTokens($token, $user);
        } catch (JWTException $e) {
            throw new InvalidTokenException("Invalid token: " . $e->getMessage());
        }
    }
}
