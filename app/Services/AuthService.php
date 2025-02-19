<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\InvalidTokenException;
use App\Models\User;

interface AuthService
{
    /**
     * @throws InvalidCredentialsException
     */
    public function login(array $credentials): array;

    /**
     * @throws InvalidTokenException
     */
    public function refreshTokens(string $token): array;
}
