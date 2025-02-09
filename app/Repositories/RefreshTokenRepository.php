<?php

namespace App\Repositories;

interface RefreshTokenRepository
{
    public function create(string $token);
    public function find(string $token);
}
