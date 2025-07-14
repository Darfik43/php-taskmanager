<?php

namespace App\Authentication\Services;

use App\Authentication\Exceptions\InvalidCredentialsException;
use App\Authentication\Exceptions\InvalidTokenException;
use App\Authentication\Models\User;
use App\Email\Http\Exceptions\EmailNotVerifiedException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserService $userService,
        private readonly JWTService     $jwtService
    )
    {
    }

    /**
     * @throws EmailNotVerifiedException
     * @throws InvalidCredentialsException
     */
    public function login(array $credentials): array
    {
        $user = $this->getAuthenticatingUser($credentials);

        if (!$this->isEmailVerified($user)) {
            throw new EmailNotVerifiedException('Email not verified');
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

    /**
     * @throws InvalidCredentialsException
     */
    private function getAuthenticatingUser(array $credentials): User
    {
        $user = $this->userService->getUserByEmail($credentials['email']);

        if (!$this->isPasswordValid($user, $credentials['password'])) {
            throw new InvalidCredentialsException('Invalid credentials');
        }

        return $user;
    }
    private function isPasswordValid(?User $user, string $password): bool
    {
        return $user && Hash::check($password, $user->password);
    }

    private function isEmailVerified(User $user): bool
    {
        return $this->userService->isEmailVerified($user['id']);
    }
}
