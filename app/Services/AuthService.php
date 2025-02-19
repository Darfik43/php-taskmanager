<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\InvalidTokenException;

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
