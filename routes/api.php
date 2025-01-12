<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ServiceListController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\User\ProfileController;
use App\Http\Controllers\Api\V1\ServiceController;
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

    // Oturum gerektiren rotalar
    Route::middleware('auth:api')->group(function () {
        // Profil rotaları
        Route::prefix('profile')->group(function () {
            Route::put('update', [ProfileController::class, 'update']); //www.saglik.com/api/v1/profile/update
            Route::post('upload-photo', [ProfileController::class, 'uploadPhoto']); //www.saglik.com/api/v1/profile/upload-photo
            Route::post('change-password', [ProfileController::class, 'changePassword']);
        });

        // Favori listesi rotaları
        Route::prefix('favorites')->group(function () {
            Route::post('add', [ServiceListController::class, 'addToFavorites']);
            Route::post('remove', [ServiceListController::class, 'removeFromFavorites']);
            Route::get('/', [ServiceListController::class, 'getFavorites']);
        });

        // Karşılaştırma listesi rotaları
        Route::prefix('comparisons')->group(function () {
            Route::post('add', [ServiceListController::class, 'addToComparisons']);
            Route::post('remove', [ServiceListController::class, 'removeFromComparisons']);
            Route::get('/', [ServiceListController::class, 'getComparisons']);
        });

        // Yorum yönetimi rotaları (Auth required)
        Route::prefix('comments')->group(function () {
            Route::post('add', [CommentController::class, 'addComment']);
            Route::delete('{commentId}', [CommentController::class, 'deleteComment']);
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
