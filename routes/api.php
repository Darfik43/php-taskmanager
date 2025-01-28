<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', AuthController::class)
    -> middleware(['auth:api', 'throttle:api']);
