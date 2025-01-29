<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;

class AuthController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function update(LoginRequest $loginRequest)
    {

    }
}
