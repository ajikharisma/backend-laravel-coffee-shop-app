<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| AUTH (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/products/latest', [ProductController::class, 'latest']);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // ===== AUTH =====
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // ===== PRODUCTS (CRUD) =====
    Route::get('/products', [ProductController::class, 'index']);       // list produk
    Route::post('/products', [ProductController::class, 'store']);      // tambah produk
    Route::get('/products/{product}', [ProductController::class, 'show']); // detail produk
    Route::put('/products/{product}', [ProductController::class, 'update']); // update produk
    Route::delete('/products/{product}', [ProductController::class, 'destroy']); // hapus produk
});
