<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
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

    /**
     * @throws UserNotFoundException
     */
    public function getUserById(int $id): User
    {
        return $this->userRepository->findById($id)
            ?? throw new UserNotFoundException('User not found');
    }
}
