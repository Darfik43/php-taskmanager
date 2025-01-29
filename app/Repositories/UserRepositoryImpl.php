<?php

namespace App\Repositories;

use App\Models\User;

class UserRepositoryImpl implements UserRepository
{
    public function findByEmail(string $email): User
    {
        return User::whereEmail($email);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }
}
