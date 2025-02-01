<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserServiceImpl implements UserService
{

    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function createUser(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $this->userRepository->create($data);
    }
}
