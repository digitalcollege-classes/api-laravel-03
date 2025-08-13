<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cart;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function index(): mixed
    {
        return Cart::all(); // SELECT * FROM Carts;
    }

    public function show(string $id): mixed
    {
        return Cart::findOrFail($id);
    }

    public function store(Request $request): mixed
    {
        // teria que fazer uma valida dos dados
        return Cart::create($request->toArray());
    }

    public function destroy(string $id): mixed
    {
        $cart = Cart::findOrFail($id);

        if (!$cart) {
            return response()->json(status: 404);
        }

        $cart->delete();

        return response()->json(status: 204);
    }
}

// php artisan migrate
