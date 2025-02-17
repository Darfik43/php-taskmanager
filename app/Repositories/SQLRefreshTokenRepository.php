<?php

namespace App\Repositories;

use App\Models\RefreshToken;

class SQLRefreshTokenRepository implements RefreshTokenRepository
{

    public function create(array $token): void
    {
        RefreshToken::create($token);
    }

    public function findByToken(string $token): ?RefreshToken
    {
        return RefreshToken::where('token', $token)->first();
    }

    public function delete(string $token): void
    {
        RefreshToken::where('token', $token)->delete();
    }
}
