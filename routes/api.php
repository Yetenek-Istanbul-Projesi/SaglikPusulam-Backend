<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ServiceListController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () { //www.saglikpusulam.com/api/v1
    Route::post('/register', [AuthController::class, 'register']); //www.saglikpusulam.com/api/v1/register
    Route::post('/verify-registration', [AuthController::class, 'verifyRegistration']); //www.saglikpusulam.com/api/v1/verify-registration
    Route::post('/login', [AuthController::class, 'login']);   //www.saglikpusulam.com/api/v1/login

    Route::prefix('auth')->group(function () {
        Route::post('forgot-password', [PasswordResetController::class, 'forgotPassword']);
        Route::post('reset-password', [PasswordResetController::class, 'reset']);
    });

    // Yorum rotaları (Herkes için)
    Route::post('/comments', [CommentController::class, 'addComment']);
    Route::get('/services/{serviceId}/comments', [CommentController::class, 'getServiceComments']);

    // Oturum gerektiren rotalar
    Route::middleware('auth:sanctum')->group(function () {
        // Favori listesi rotaları
        Route::post('/favorites/add', [ServiceListController::class, 'addToFavorites']);
        Route::post('/favorites/remove', [ServiceListController::class, 'removeFromFavorites']);
        Route::get('/favorites', [ServiceListController::class, 'getFavorites']);

        // Karşılaştırma listesi rotaları
        Route::post('/comparisons/add', [ServiceListController::class, 'addToComparisons']);
        Route::post('/comparisons/remove', [ServiceListController::class, 'removeFromComparisons']);
        Route::get('/comparisons', [ServiceListController::class, 'getComparisons']);

        // Yorum yönetimi rotaları
        Route::delete('/comments/{commentId}', [CommentController::class, 'deleteComment']);
    });

    // Admin rotaları
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/comments/pending', [CommentController::class, 'getPendingComments']);
        Route::patch('/comments/{commentId}/status', [CommentController::class, 'updateCommentStatus']);
    });
});
