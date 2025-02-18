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
        $this->redis->hmset(
            "refresh_token:{$token['user_id']}",
            [
                'token' => $token['token'],
                'created_at' => $token['created_at'],
                'expires_at' => $token['expires_at']
            ]
        );
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
