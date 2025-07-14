<?php

namespace App\Authentication\Repositories;

use App\Authentication\Models\User;

class UserRepositoryImpl implements UserRepository
{
    public function findByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }
}
