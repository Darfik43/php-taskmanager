<?php

namespace App\Repositories;

interface RefreshTokenRepository
{
    public function create(array $token);
    public function find(string $token);
}
