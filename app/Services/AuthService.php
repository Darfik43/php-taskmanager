<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;

interface AuthService
{
    /**
     * @throws InvalidCredentialsException
     */
    public function login(array $credentials): array;

    public function refreshTokens(string $token): array;
}
