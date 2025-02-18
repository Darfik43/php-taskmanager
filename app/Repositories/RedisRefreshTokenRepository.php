<?php

namespace App\Repositories;

use App\Models\RefreshToken;
use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;

class RedisRefreshTokenRepository implements RefreshTokenRepository
{
    private Connection $redis;
    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function create(array $token): void
    {
        $this->redis->hmset(
            "refresh_token:{$token['token']}",
            [
                'user_id' => $token['user_id'],
                'created_at' => $token['created_at'],
                'expires_at' => $token['expires_at']
            ]
        );
    }

    public function findByToken(string $token): ?RefreshToken
    {
        $tokenData = $this->redis->hgetall($token);
        if (empty($tokenData)) {
            return null;
        }

        return new RefreshToken([
            'token' => $tokenData['token'],
            'created_at' => $tokenData['created_at'],
            'expires_at' => $tokenData['expires_at'],
            'user_id'  => $tokenData['user_id']
        ]);
    }

    public function delete(string $token): void
    {
        $this->redis->del($token);
    }
}
