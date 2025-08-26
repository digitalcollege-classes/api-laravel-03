<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function getAll(): mixed
    {
        //paginar os resultados
        $categorias = Category::paginate(10);

        return $categorias;
    }

    public function filter(string $expression): JsonResponse
    {
        if (Cache::store('file')->get('expression') === $expression) {
            return response()->json([
                'error' => 'Não encontrada (cache)',
            ], 404);
        }

        //busca no banco
        $result = Category::where('nome', 'LIKE', "%{$expression}%")->get();

        if ($result->count() === 0) {
            Cache::store('file')->put('expression', $expression);

            return response()->json([
                'error' => 'Não encontrada',
            ], 404);
        }

        return response()->json($result);
    }
}
