<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(SignupRequest $signupRequest) : User {
        $incomingFields = $signupRequest->validated();

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        return User::create($incomingFields);
    }
}
