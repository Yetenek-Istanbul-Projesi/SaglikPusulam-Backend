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
use App\Contracts\Repositories\HealthPlaceRepositoryInterface;
use App\Contracts\Repositories\ProfileRepositoryInterface;
use App\Contracts\Services\HealthDetailsServiceInterface;
use App\Contracts\Services\ReviewServiceInterface;
use App\Repositories\GooglePlacesRepository;
use App\Repositories\UserRepository;
use App\Repositories\HealthPlaceRepository;
use App\Repositories\ProfileRepository;
use App\Services\Auth\VerificationService;
use App\Services\Comment\CommentService;
use App\Services\Service\ServiceManagementService;
use App\Services\Service\ServiceListService;
use App\Services\User\UserService;
use App\Services\User\ProfileService;
use App\Services\Google\GooglePlacesServiceV2;
use App\Services\HealthDetailsService;
use App\Services\ReviewService;
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

        // Profile Services & Repositories
        $this->app->singleton(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->singleton(ProfileServiceInterface::class, function ($app) {
            return new ProfileService(
                $app->make(ProfileRepositoryInterface::class),
                $app->make(GooglePlacesServiceInterface::class),
                $app->make(HealthPlaceRepositoryInterface::class)
            );
        });

        // Google Places Services
        $this->app->singleton(GooglePlacesServiceInterface::class, GooglePlacesServiceV2::class);
        $this->app->singleton(GooglePlacesRepositoryInterface::class, GooglePlacesRepository::class);

        // Health Profile Services & Repositories
        $this->app->singleton(HealthPlaceRepositoryInterface::class, HealthPlaceRepository::class);
        $this->app->singleton(HealthDetailsServiceInterface::class, HealthDetailsService::class);

        // Review Service
        $this->app->singleton(ReviewServiceInterface::class, function ($app) {
            return new ReviewService(
                $app->make(GooglePlacesServiceInterface::class),
                $app->make(HealthPlaceRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
