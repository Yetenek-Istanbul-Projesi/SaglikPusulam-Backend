<?php

namespace App\Providers;

use App\Contracts\CommentServiceInterface;
use App\Contracts\ServiceManagementInterface;
use App\Contracts\ServiceListServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\VerificationServiceInterface;
use App\Repositories\UserRepository;
use App\Services\Auth\VerificationService;
use App\Services\Comment\CommentService;
use App\Services\Service\ServiceManagementService;
use App\Services\Service\ServiceListService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);

        // Auth & User Services
        $this->app->singleton(UserServiceInterface::class, UserService::class);
        $this->app->singleton(VerificationServiceInterface::class, VerificationService::class);

        // Service Management Services
        $this->app->singleton(ServiceManagementInterface::class, ServiceManagementService::class);
        $this->app->singleton(ServiceListServiceInterface::class, ServiceListService::class);

        // Comment Services
        $this->app->singleton(CommentServiceInterface::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
