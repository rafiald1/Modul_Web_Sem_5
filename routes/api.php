<?php
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/user', function (Request $request) {
return $request->user();
})->middleware(Authenticate::using('sanctum'));
//posts
Route::apiResource('/produks', App\Http\Controllers\Api\ProdukController::class);
Route::apiResource('/kontaks', App\Http\Controllers\Api\KontakController::class);