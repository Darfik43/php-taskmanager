<?php

namespace App\Repositories;

use App\Models\RefreshToken;

class RefreshTokenRepositoryImpl implements RefreshTokenRepository
{

    public function create(array $token)
    {
        RefreshToken::create($token);
    }

    public function find(string $token)
    {
        // TODO: Implement find() method.
    }
}
