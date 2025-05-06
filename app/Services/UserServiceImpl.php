<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;

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
        $user = $this->userRepository->create($data);
        event(new Registered($user));
        return $user;

    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->findById($id)
            ?? throw new UserNotFoundException('User not found');
    }
}
