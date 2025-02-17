<?php

namespace App\Repositories;

use App\Models\RefreshToken;
use Illuminate\Support\Facades\Redis;

class RedisRefreshTokenRepository implements RefreshTokenRepository
{
    private $redis;
    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function create(array $token): void
    {
        // TODO: Implement create() method.
    }

    public function findByToken(string $token): ?RefreshToken
    {
        // TODO: Implement findByToken() method.
    }

    public function delete(string $token): void
    {
        // TODO: Implement delete() method.
    }
}
