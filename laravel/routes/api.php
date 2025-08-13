<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/anuncios', AnuncioController::class);
Route::apiResource('/produtos', ProdutoController::class);
Route::apiResource('/categorias', CategoriaController::class);
Route::apiResource('/carrinhos', CarrinhoController::class);