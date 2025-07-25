<?php

namespace App\Authentication\Services;

use App\Authentication\Exceptions\UserNotFoundException;
use App\Authentication\Models\User;
use App\Authentication\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use function App\Services\bcrypt;
use function App\Services\event;

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

    /**
     * @throws UserNotFoundException
     */
    public function isEmailVerified(int $id): bool
    {
        return $this->getUserById($id)->hasVerifiedEmail();
    }

    /**
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): User
    {
        return $this->userRepository->findByEmail($email)
            ?? throw new UserNotFoundException('User not found');
    }
}
