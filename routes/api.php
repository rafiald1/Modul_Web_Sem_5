<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk mendapatkan informasi pengguna yang terautentikasi
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

// Route untuk resource posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
