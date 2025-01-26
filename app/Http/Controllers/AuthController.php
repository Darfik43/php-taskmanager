<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) : User {
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:50'],
            'passwordConfirmation' => ['required', 'min:5', 'max:50']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        return User::create($incomingFields);
    }
}
