<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max50'],
            'passwordConfirmation' => ['required', 'min:5', 'max50']
        ]);
        return 'test';
    }
}
