<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\InvalidTokenException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly JWTService $jwtService
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

        return $this->jwtService->generateTokens($user);
    }

    /**
     * @throws InvalidTokenException
     */
    public function refreshTokens(string $token): array
    {
        return $this->jwtService->refreshTokens($token);
    }
}
