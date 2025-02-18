<?php

namespace App\Services;

use Tymon\JWTAuth\Contracts\JWTSubject;

interface JWTService
{
    public function generateTokens(JWTSubject $user): array;

    public function refreshTokens(string $token, JWTSubject $user): array;
}
