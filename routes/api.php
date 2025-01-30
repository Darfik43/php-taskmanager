<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);

Route::prefix('auth')->group(function (){
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
   //TODO add routes that must be protected
});
