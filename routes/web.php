<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
Route::get('/', function () {
    return view('pages.home');
});


Route::get('/account/register', function () {
    return view('pages.auth.register');
});

Route::get('/account/login', function () {
    return view('pages.auth.login');
});

Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show']);
