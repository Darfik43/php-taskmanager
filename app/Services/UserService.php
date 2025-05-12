<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

interface UserService
{
    public function createUser(array $data): User;

    /**
     * @throws UserNotFoundException
     */
    public function getUserById(int $id): User;
    public function getUserByEmail(string $email): User;
    public function isEmailVerified(int $id): bool;
}
