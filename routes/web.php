<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;


// Ana sayfa
Route::get('/', function () {
    return view('pages.home');
});

// Kayıt sayfası
Route::get('/account/register', function () {
    return view('pages.auth.register');
});

// Giriş sayfası
Route::get('/account/login', function () {
    return view('pages.auth.login');
});

// Blog sayfası
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show']);