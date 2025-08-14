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

// Rotas de anúncios (mantendo as existentes)
Route::apiResource('/anuncios', AnuncioController::class);

// Rotas de categorias
Route::apiResource('/categorias', CategoryController::class);

// Rotas de produtos
Route::apiResource('/produtos', ProductController::class);

// Rotas de carrinhos
Route::post('/carrinhos', [CartController::class, 'store']);
Route::get('/carrinhos/{id}', [CartController::class, 'show']);
Route::post('/carrinhos/{id}/produtos', [CartController::class, 'addProduct']);
Route::delete('/carrinhos/{carrinho_id}/produtos/{produto_id}', [CartController::class, 'removeProduct']);
Route::put('/carrinhos/{carrinho_id}/produtos/{produto_id}', [CartController::class, 'updateProductQuantity']);
Route::post('/carrinhos/{id}/finalizar', [CartController::class, 'finalize']);
