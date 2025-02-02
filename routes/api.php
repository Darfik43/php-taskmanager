<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::apiResource('tasks', TaskController::class);

Route::prefix('auth')->group(function (){
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware([JwtMiddleware::class])->group(function () {
   Route::apiResource('tasks', TaskController::class);
});
