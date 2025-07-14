<?php

namespace App\Authentication\Http\Controllers;

use App\Authentication\Exceptions\InvalidCredentialsException;
use App\Authentication\Http\Requests\LoginRequest;
use App\Authentication\Http\Requests\RefreshTokenRequest;
use App\Authentication\Http\Resources\AuthResource;
use App\Authentication\Services\AuthService;

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
            throw $e; //TODO Mocked logic of throwing need to be handled somewhere, now we throw exception in service and here
        }
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function refresh(RefreshTokenRequest $request): AuthResource
    {
        try {
            $response = $this->authService->refreshTokens($request->validated()['refreshToken']);
            return new AuthResource($response);
        } catch (InvalidCredentialsException $e) {
            throw $e; //TODO Mocked logic of throwing need to be handled somewhere, now we throw exception in service and here
        }

    }
}
