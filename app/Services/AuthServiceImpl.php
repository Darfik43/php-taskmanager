<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function login(array $credentials): array
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new InvalidCredentialsException('Invalid credentials');
        }

        return $this->generateTokenResponse($user);
    }

    //TODO separate method to generate response/generate tokens
}
