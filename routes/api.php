<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserCartController;
use Illuminate\Support\Facades\Route;


// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Products
Route::prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::get('{id}', [ProductController::class, 'show']);
});

// Private routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // Products
    Route::prefix('products')->group(function () {
        Route::post('', [ProductController::class, 'store']);
        Route::put('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'destroy']);
    });

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('product', [UserCartController::class, 'index']);
        Route::post('', [CartController::class, 'store']);
        Route::post('product', [UserCartController::class, 'addProduct']);
        Route::delete('product/{productId}', [UserCartController::class, 'deleteProduct']);
    });
});
