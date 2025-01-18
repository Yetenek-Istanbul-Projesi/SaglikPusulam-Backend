<?php

namespace App\Providers;

use App\Contracts\CommentServiceInterface;
use App\Contracts\Services\GooglePlacesServiceInterface;
use App\Contracts\ServiceManagementInterface;
use App\Contracts\ServiceListServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\VerificationServiceInterface;
use App\Contracts\Services\ProfileServiceInterface;
use App\Contracts\Repositories\GooglePlacesRepositoryInterface;
use App\Repositories\GooglePlacesRepository;
use App\Repositories\UserRepository;
use App\Services\Auth\VerificationService;
use App\Services\Comment\CommentService;
use App\Services\Service\ServiceManagementService;
use App\Services\Service\ServiceListService;
use App\Services\User\UserService;
use App\Services\User\ProfileService;
use App\Services\Google\GooglePlacesServiceV2;
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
        $this->app->singleton(ProfileServiceInterface::class, ProfileService::class);

        // Service Management Services
        $this->app->singleton(ServiceManagementInterface::class, ServiceManagementService::class);
        $this->app->singleton(ServiceListServiceInterface::class, ServiceListService::class);

        // Comment Services
        $this->app->singleton(CommentServiceInterface::class, CommentService::class);

        // Google Places Services
        $this->app->singleton(GooglePlacesServiceInterface::class, GooglePlacesServiceV2::class);
        $this->app->singleton(GooglePlacesRepositoryInterface::class, GooglePlacesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
