<?php

namespace App\Repositories;

use App\Models\RefreshToken;

interface RefreshTokenRepository
{
    public function create(array $token): void;
    public function find(string $token): ?RefreshToken;
}
