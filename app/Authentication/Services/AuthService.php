<?php

namespace App\Authentication\Services;

use App\Authentication\Exceptions\InvalidCredentialsException;
use App\Authentication\Exceptions\InvalidTokenException;

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
