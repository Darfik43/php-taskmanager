<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtMiddleware;
use App\Task\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::apiResource('tasks', TaskController::class);

Route::prefix('auth')->group(function (){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::prefix('email')->group(function() {
    Route::post('/verify/{id}/{hash}', [EmailController::class, 'verify'])->name('verification.verify');
});

Route::middleware([JwtMiddleware::class])->group(function () {
   Route::apiResource('tasks', TaskController::class);
});
