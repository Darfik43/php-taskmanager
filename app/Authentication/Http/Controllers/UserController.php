<?php

namespace App\Authentication\Http\Controllers;

use App\Authentication\Http\Requests\SignupRequest;
use App\Authentication\Http\Resources\UserResource;
use App\Authentication\Services\UserServiceImpl;

class UserController extends Controller
{
    public function __construct(private readonly UserServiceImpl $userService)
    {}

    public function store(SignupRequest $signupRequest) : UserResource
    {
        $user = $this->userService->createUser($signupRequest->validated());

        return new UserResource($user);
    }
}
