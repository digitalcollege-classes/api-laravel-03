<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    public function index(): mixed
    {
        return Product::all(); // SELECT * FROM Products;
    }

    public function show(string $id): mixed
    {
        return Product::findOrFail($id);
    }

    public function store(Request $request): mixed
    {
        // teria que fazer uma valida dos dados
        return Product::create($request->toArray());
    }

    public function destroy(string $id): mixed
    {
        $product = Product::findOrFail($id);

        if (!$product) {
            return response()->json(status: 404);
        }

        $product->delete();

        return response()->json(status: 204);
    }
}

// php artisan migrate
