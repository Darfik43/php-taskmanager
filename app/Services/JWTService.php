<?php

namespace App\Services;

interface JWTService
{
    public function generateTokens($user): array;
}
