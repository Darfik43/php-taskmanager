<?php

namespace App\Authentication\Services;

use App\Authentication\Exceptions\InvalidTokenException;
use Tymon\JWTAuth\Contracts\JWTSubject;

interface JWTService
{
    public function generateTokens(JWTSubject $user): array;

    /**
     * @throws InvalidTokenException
     */
    public function refreshTokens(string $token, JWTSubject $user): array;
}
