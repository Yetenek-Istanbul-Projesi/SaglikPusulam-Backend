<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ServiceListController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\User\ProfileController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\GooglePlacesController;
use App\Http\Controllers\Api\V1\HealthSearchController;
use App\Http\Controllers\Api\V1\HealthDetailsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Auth rotaları (Public)
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']); //www.saglik.com/api/v1/auth/register
        Route::post('login', [AuthController::class, 'login']); //www.saglik.com/api/v1/auth/login
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']); //www.saglik.com/api/v1/auth/forgot-password
        Route::post('reset-password', [AuthController::class, 'resetPassword']); //www.saglik.com/api/v1/auth/reset-password
        Route::post('verify', [AuthController::class, 'verifyRegistration']); //www.saglik.com/api/v1/auth/verify
    });

    // Sağlık hizmeti arama ve filtreleme rotaları
    Route::prefix('health')->group(function () {
        Route::get('most-favorited', [HealthDetailsController::class, 'getMostFavorited']); //www.saglik.com/api/v1/health/most-favorited
        Route::post('search', [HealthSearchController::class, 'search']); //www.saglik.com/api/v1/health/search
        Route::post('filter', [HealthSearchController::class, 'filter']); //www.saglik.com/api/v1/health/filter   
        Route::get('load-more', [HealthSearchController::class, 'loadMore']); //www.saglik.com/api/v1/health/load-more
        Route::get('details/search', [HealthDetailsController::class, 'findSearchInResults']); //www.saglik.com/api/v1/health/details/search
        Route::get('details/database', [HealthDetailsController::class, 'findInDatabase']); //www.saglik.com/api/v1/health/details/database

        Route::prefix('details')->group(function () {
            Route::get('{placeId}/reviews', [HealthDetailsController::class, 'getReviews']); //www.saglik.com/api/v1/health/details/{placeId}/reviews
            Route::middleware('jwt.auth')->group(function () {
                Route::post('{placeId}/add-review', [HealthDetailsController::class, 'addReview']); // saglik.com/api/v1/health/details/{placeId}/add-review
                Route::delete('{placeId}/delete-review', [HealthDetailsController::class, 'deleteReview']); // saglik.com/api/v1/health/details/{placeId}/delete-review
                Route::put('{placeId}/update-review', [HealthDetailsController::class, 'updateReview']); // saglik.com/api/v1/health/details/{placeId}/update-review
            });
        });
    });


    // Google Places API rotaları
    Route::prefix('places')->group(function () {
        Route::get('search', [GooglePlacesController::class, 'search']); //www.saglik.com/api/v1/places/search
        Route::get('{placeId}/details', [GooglePlacesController::class, 'getDetails']); //www.saglik.com/api/v1/places/{placeId}/details    
        Route::get('photo/{photoReference}', [GooglePlacesController::class, 'getPhoto']) //www.saglik.com/api/v1/places/photo/{photoReference}
            ->name('api.places.photo')
            ->where('photoReference', '.*');
    });

    // Oturum gerektiren rotalar
    Route::middleware('jwt.auth')->group(function () {
        // Profil rotaları
        Route::prefix('profile')->group(function () {
            Route::put('update', [ProfileController::class, 'update']); //www.saglik.com/api/v1/profile/update
            Route::post('upload-photo', [ProfileController::class, 'uploadPhoto']); //www.saglik.com/api/v1/profile/upload-photo
            Route::post('change-password', [ProfileController::class, 'changePassword']); //www.saglik.com/api/v1/profile/change-password
            Route::get('favorites', [ProfileController::class, 'getFavorites']); //www.saglik.com/api/v1/profile/favorites  
            Route::get('comparisons', [ProfileController::class, 'getComparisons']); //www.saglik.com/api/v1/profile/comparisons
            Route::post('favorites/{placeId}', [ProfileController::class, 'toggleFavorite']); //www.saglik.com/api/v1/profile/favorites/{placeId}
            Route::post('comparisons/{placeId}', [ProfileController::class, 'toggleComparison']); //www.saglik.com/api/v1/profile/comparisons/{placeId}
            Route::get('check-lists/{placeId}', [ProfileController::class, 'checkLists']); //www.saglik.com/api/v1/profile/check-lists/{placeId}
            Route::get('reviews', [HealthDetailsController::class, 'getUserReviews']); //www.saglik.com/api/v1/profile/reviews
        });
    });
});
