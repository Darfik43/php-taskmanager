<?php

namespace App\Authentication\Repositories;

use App\Authentication\Models\RefreshToken;

interface RefreshTokenRepository
{
    public function create(array $token): void;
    public function findByToken(string $token): ?RefreshToken;
    public function delete(string $token): void;
}
