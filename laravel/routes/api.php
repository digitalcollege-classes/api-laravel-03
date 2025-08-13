<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/anuncios', AnuncioController::class);

 Route::apiResource('/categories', CategoryController::class);
 Route::apiResource('/products', ProductController::class);
 Route::apiResource('/carts', CartController::class); 