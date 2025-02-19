<?php

namespace App\Providers;

use App\Repositories\RedisRefreshTokenRepository;
use App\Repositories\RefreshTokenRepository;
use App\Repositories\SQLRefreshTokenRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryImpl;
use App\Services\AuthService;
use App\Services\AuthServiceImpl;
use App\Services\JWTService;
use App\Services\JWTServiceImpl;
use App\Services\UserService;
use App\Services\UserServiceImpl;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
