<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Services\UserServiceImpl;

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
