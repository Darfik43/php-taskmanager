<?php

namespace App\Authentication\Services;

use App\Authentication\Exceptions\UserNotFoundException;
use App\Authentication\Models\User;

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
