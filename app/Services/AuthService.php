<?php

namespace App\Services;

use App\Models\User;

interface AuthService
{
    public function login(array $credentials): array;

    public function refreshTokens(string $token): array;
}
