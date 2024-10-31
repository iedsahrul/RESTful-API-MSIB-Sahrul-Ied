<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route yang membutuhkan proteksi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/products/search', [ProductController::class, 'searchByName']);
    Route::get('/products', [ProductController::class, 'index']);
});

Route::apiResource('products', ProductController::class)->except(['index']); // Exclude index jika dilindungi middleware di atas

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);