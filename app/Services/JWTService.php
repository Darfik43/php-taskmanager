<?php

namespace App\Services;

use App\Exceptions\InvalidTokenException;
use Tymon\JWTAuth\Contracts\JWTSubject;

interface JWTService
{
    public function generateTokens(JWTSubject $user): array;

    /**
     * @throws InvalidTokenException
     */
    public function refreshTokens(string $token): array;
}
