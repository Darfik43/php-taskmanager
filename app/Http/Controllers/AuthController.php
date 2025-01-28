<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(SignupRequest $signupRequest) : User {
        $signupRequest['password'] = bcrypt($signupRequest['password']);

        return User::create($signupRequest->validated());
    }
}
