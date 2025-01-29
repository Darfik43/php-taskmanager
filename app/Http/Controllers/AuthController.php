<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use App\Services\UserService;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}


    /**
     * @throws InvalidCredentialsException
     */
    public function login(LoginRequest $loginRequest): AuthResource
    {
        try {
            $response = $this->authService->login($loginRequest->validated());
            return new AuthResource($response);
        } catch (InvalidCredentialsException $e) {
            throw $e; //TODO Mocked logic of throwing
        }
    }
}
