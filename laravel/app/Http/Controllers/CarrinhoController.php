<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Carrinho;
use Symfony\Component\HttpFoundation\Request;

class CarrinhoController extends Controller
{
    public function index(): mixed
    {
        return Carrinho::all();
    }

    public function show(string $id): mixed
    {
        return Carrinho::findOrFail($id);
    }

    public function store(Request $request): mixed
    {
        return Carrinho::create($request->toArray());
    }

    public function update(Request $request, string $id): mixed
    {
        $carrinho = Carrinho::findOrFail($id);
        $carrinho->update($request->toArray());
        return $carrinho;
    }

    public function destroy(string $id): mixed
    {
        $carrinho = Carrinho::findOrFail($id);

        if (!$carrinho) {
            return response()->json(status: 404);
        }

        $carrinho->delete();

        return response()->json(status: 204);
    }
}
