<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () { //www.saglikpusulam.com/api/v1
    Route::post('/register', [AuthController::class, 'register']); //www.saglikpusulam.com/api/v1/register
    Route::post('/login', [AuthController::class, 'login']);   //www.saglikpusulam.com/api/v1/login
});
