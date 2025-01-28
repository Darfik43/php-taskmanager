<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(SignupRequest $signupRequest) : UserResource
    {
        $user = $this->userService->createUser($signupRequest->validated());

        return new UserResource($user);
    }
}
