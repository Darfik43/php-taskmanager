<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\RefreshTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::apiResource('tasks', TaskController::class);

Route::prefix('auth')->group(function (){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh'])
    ->middleware(RefreshTokenMiddleware::class);
});

Route::middleware([JwtMiddleware::class])->group(function () {
//   Route::apiResource('tasks', TaskController::class);
});
