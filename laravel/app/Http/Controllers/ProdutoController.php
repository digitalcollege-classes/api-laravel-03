<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Produto;
use Symfony\Component\HttpFoundation\Request;

class ProdutoController extends Controller
{
    public function index(): mixed
    {
        return Produto::all();
    }

    public function show(string $id): mixed
    {
        return Produto::findOrFail($id);
    }

    public function store(Request $request): mixed
    {
        return Produto::create($request->toArray());
    }

    public function destroy(string $id): mixed
    {
        $produto = Produto::findOrFail($id);

        if (!$produto) {
            return response()->json(status: 404);
        }

        $produto->delete();

        return response()->json(status: 204);
    }
}
