<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Categoria;
use Symfony\Component\HttpFoundation\Request;

class CategoriaController extends Controller
{
    public function index(): mixed
    {
        return Categoria::all();
    }

    public function show(string $id): mixed
    {
        return Categoria::findOrFail($id);
    }

    public function store(Request $request): mixed
    {
        return Categoria::create($request->toArray());
    }

    public function destroy(string $id): mixed
    {
        $categoria = Categoria::findOrFail($id);

        if (!$categoria) {
            return response()->json(status: 404);
        }

        $categoria->delete();

        return response()->json(status: 204);
    }
}
