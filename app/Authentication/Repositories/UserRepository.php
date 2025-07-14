<?php

namespace App\Authentication\Repositories;

use App\Authentication\Models\User;

interface UserRepository
{
    public function create(array $data): User;
    public function findByEmail(string $email): ?User;

    public function findById(int $id): ?User;
}
