<?php

namespace App\Repositories;

use App\Models\RefreshToken;

class RefreshTokenRepositoryImpl implements RefreshTokenRepository
{

    public function create(array $token): void
    {
        RefreshToken::create($token);
    }

    public function findByToken(string $token): ?RefreshToken
    {
        return RefreshToken::where('token', $token);
    }
}
