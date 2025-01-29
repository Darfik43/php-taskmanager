<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByEmail(string $email) : User {
        return User::whereEmail($email);
    }

    public function create(array $data)
    {
        return User::create($data);
    }
}
