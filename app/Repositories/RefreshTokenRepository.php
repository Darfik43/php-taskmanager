<?php

namespace App\Repositories;

use App\Models\RefreshToken;

interface RefreshTokenRepository
{
    public function create(array $token): void;
    public function findByToken(string $token): ?RefreshToken;
    public function delete(string $token): void;
}
