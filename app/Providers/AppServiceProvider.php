<?php

namespace App\Providers;

use App\Authentication\Repositories\RedisRefreshTokenRepository;
use App\Authentication\Repositories\RefreshTokenRepository;
use App\Authentication\Repositories\UserRepository;
use App\Authentication\Repositories\UserRepositoryImpl;
use App\Authentication\Services\AuthService;
use App\Authentication\Services\AuthServiceImpl;
use App\Authentication\Services\JWTService;
use App\Authentication\Services\JWTServiceImpl;
use App\Authentication\Services\UserService;
use App\Authentication\Services\UserServiceImpl;
use App\Email\Services\EmailVerificationService;
use App\Email\Services\EmailVerificationServiceImpl;
use App\Task\Repositories\TaskRepository;
use App\Task\Repositories\TaskRepositoryImpl;
use App\Task\Services\TaskService;
use App\Task\Services\TaskServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(JWTService::class, JWTServiceImpl::class);
        $this->app->bind(RefreshTokenRepository::class, RedisRefreshTokenRepository::class);
        $this->app->bind(EmailVerificationService::class, EmailVerificationServiceImpl::class);
        $this->app->bind(TaskRepository::class, TaskRepositoryImpl::class);
        $this->app->bind(TaskService::class, TaskServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
