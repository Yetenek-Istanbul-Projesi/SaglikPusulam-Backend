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
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
        Route::post('verify', [AuthController::class, 'verifyRegistration']);
    });

    // Health search and filter routes
    Route::prefix('health')->group(function () {
        Route::post('search', [HealthSearchController::class, 'search']);
        Route::post('filter', [HealthSearchController::class, 'filter']);
        Route::get('load-more', [HealthSearchController::class, 'loadMore']);
        Route::get('details', [HealthDetailsController::class, 'findSearchInResults']);

    });

    // Servis rotaları (Public)
    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index']);
        Route::get('/{service}', [ServiceController::class, 'show']);
        Route::get('/{service}/comments', [ServiceController::class, 'comments']);
    });

    // Yorum rotaları (Public)
    Route::prefix('comments')->group(function () {
        Route::get('/service/{serviceId}', [CommentController::class, 'getServiceComments']);
    });

    // Google Places API routes
    Route::prefix('places')->group(function () {
        Route::get('search', [GooglePlacesController::class, 'search']);
        Route::get('{placeId}/details', [GooglePlacesController::class, 'getDetails']);
        Route::get('photo/{photoReference}', [GooglePlacesController::class, 'getPhoto'])
            ->name('api.places.photo')
            ->where('photoReference', '.*');
    });

    // Oturum gerektiren rotalar
    Route::middleware('auth:api')->group(function () {
        // Profil rotaları
        Route::prefix('profile')->group(function () {
            Route::put('update', [ProfileController::class, 'update']); //www.saglik.com/api/v1/profile/update
            Route::post('upload-photo', [ProfileController::class, 'uploadPhoto']); //www.saglik.com/api/v1/profile/upload-photo
            Route::post('change-password', [ProfileController::class, 'changePassword']);
            Route::get('favorites', [ProfileController::class, 'getFavorites']); //
            Route::get('comparisons', [ProfileController::class, 'getComparisons']);
            Route::post('favorites/{placeId}', [ProfileController::class, 'toggleFavorite']); // sa
            Route::post('comparisons/{placeId}', [ProfileController::class, 'toggleComparison']);
            Route::get('check-lists/{placeId}', [ProfileController::class, 'checkLists']);

            // Yorum yönetimi rotaları (Auth required)
            Route::prefix('comments')->group(function () {
                Route::post('add', [CommentController::class, 'addComment']);
                Route::delete('{commentId}', [CommentController::class, 'deleteComment']);
            });
        });


        // Admin rotaları
        Route::middleware('admin')->prefix('admin')->group(function () {
            Route::prefix('comments')->group(function () {
                Route::get('pending', [CommentController::class, 'getPendingComments']);
                Route::put('{commentId}/status', [CommentController::class, 'updateCommentStatus']);
            });
        });
    });
});
