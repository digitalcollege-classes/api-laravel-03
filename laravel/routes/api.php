<?php

use App\Http\Controllers\AnuncioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/anuncios', AnuncioController::class);
Route::apiResource('/products', ProductController::class);
Route::apiResource('/shoppingCarts', ShoppingCartController::class);
Route::apiResource('/categories', CategoryController::class);


