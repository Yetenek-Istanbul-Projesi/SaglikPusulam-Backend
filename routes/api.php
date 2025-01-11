<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ServiceListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () { //www.saglikpusulam.com/api/v1
    Route::post('/register', [AuthController::class, 'register']); //www.saglikpusulam.com/api/v1/register
    Route::post('/login', [AuthController::class, 'login']);   //www.saglikpusulam.com/api/v1/login

    // Favori ve karşılaştırma listesi rotaları (Oturum açmış kullanıcılar için)
    Route::middleware('auth:sanctum')->group(function () {
        // Favori listesi rotaları
        Route::post('/favorites/add', [ServiceListController::class, 'addToFavorites']);
        Route::post('/favorites/remove', [ServiceListController::class, 'removeFromFavorites']);
        Route::get('/favorites', [ServiceListController::class, 'getFavorites']);

        // Karşılaştırma listesi rotaları
        Route::post('/comparisons/add', [ServiceListController::class, 'addToComparisons']);
        Route::post('/comparisons/remove', [ServiceListController::class, 'removeFromComparisons']);
        Route::get('/comparisons', [ServiceListController::class, 'getComparisons']);
    });
});
