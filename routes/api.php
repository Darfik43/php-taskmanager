<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

Route::prefix('auth')->group(function (){
    Route::post('login', [AuthController::class, 'login']);
});
