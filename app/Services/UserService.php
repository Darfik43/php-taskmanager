<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryImpl;

class UserService
{
    private UserRepositoryImpl $userRepository;

    public function __construct(UserRepositoryImpl $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $this->userRepository->create($data);
    }
}
