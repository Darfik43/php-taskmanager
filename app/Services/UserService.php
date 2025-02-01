<?php

namespace App\Services;

use App\Models\User;

interface UserService
{
    public function createUser(array $data): User;
}
