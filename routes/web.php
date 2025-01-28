<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/api/v1/auth/register',
    [AuthController::class, 'register']);
