<?php

namespace App\Repositories;

use App\Models\RefreshToken;

class RefreshTokenRepositoryImpl implements RefreshTokenRepository
{

    public function create(array $token): void
    {
        RefreshToken::create($token);
    }

    public function find(string $token): ?RefreshToken
    {
        return null; // TODO: Implement find() method.
    }
}
