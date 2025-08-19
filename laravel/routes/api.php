<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authenticated user route
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public routes (no authentication required)
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);              // GET /api/products
    Route::get('/{product}', [ProductController::class, 'show']);      // GET /api/products/{product}
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);             // GET /api/categories
    Route::get('/{category}', [CategoryController::class, 'show']);    // GET /api/categories/{category}
});

Route::prefix('advertisements')->group(function () {
    Route::get('/', [AdvertisementController::class, 'index']);        // GET /api/advertisements
    Route::get('/{advertisement}', [AdvertisementController::class, 'show']); // GET /api/advertisements/{advertisement}
});

// Protected routes (authentication required)
Route::middleware(['auth:sanctum'])->group(function () {
    
    // Advertisement routes (full CRUD)
    Route::apiResource('advertisements', AdvertisementController::class);
    
    // Products management routes
    Route::prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'store']);                    // POST /api/products
        Route::put('/{product}', [ProductController::class, 'update']);          // PUT /api/products/{product}
        Route::delete('/{product}', [ProductController::class, 'destroy']);      // DELETE /api/products/{product}
        
        Route::patch('/{product}/activate', [ProductController::class, 'activate']);     // PATCH /api/products/{product}/activate
        Route::patch('/{product}/deactivate', [ProductController::class, 'deactivate']); // PATCH /api/products/{product}/deactivate
        Route::get('/category/{category}', [ProductController::class, 'byCategory']);    // GET /api/products/category/{category}
    });

    // Categories management routes
    Route::prefix('categories')->group(function () {
        Route::post('/', [CategoryController::class, 'store']);                  // POST /api/categories
        Route::put('/{category}', [CategoryController::class, 'update']);        // PUT /api/categories/{category}
        Route::delete('/{category}', [CategoryController::class, 'destroy']);    // DELETE /api/categories/{category}
    });

    // Shopping cart routes
    Route::prefix('cart')->group(function () {
        Route::get('/', [ShoppingCartController::class, 'index']);               // GET /api/cart
        Route::post('/add', [ShoppingCartController::class, 'store']);           // POST /api/cart/add
        Route::get('/{cartItem}', [ShoppingCartController::class, 'show']);      // GET /api/cart/{cartItem}
        Route::put('/{cartItem}', [ShoppingCartController::class, 'update']);    // PUT /api/cart/{cartItem}
        Route::delete('/{cartItem}', [ShoppingCartController::class, 'destroy']); // DELETE /api/cart/{cartItem}
    });
    
    // Advertisement status management routes
    Route::prefix('advertisements')->group(function () {
        // Status management routes
        Route::patch('/{advertisement}/activate', [AdvertisementController::class, 'activate']);   // PATCH /api/advertisements/{advertisement}/activate
        Route::patch('/{advertisement}/pause', [AdvertisementController::class, 'pause']);         // PATCH /api/advertisements/{advertisement}/pause
        Route::patch('/{advertisement}/sold', [AdvertisementController::class, 'markAsSold']);     // PATCH /api/advertisements/{advertisement}/sold
        Route::patch('/{advertisement}/publish', [AdvertisementController::class, 'publish']);     // PATCH /api/advertisements/{advertisement}/publish
    });
    
});