<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Symfony\Component\HttpFoundation\Request;

class AnuncioController extends Controller
{
    public function index(): mixed
    {
        return Anuncio::all(); // SELECT * FROM anuncios;
    }

    public function show(string $id): mixed
    {
        return Anuncio::findOrFail($id);
    }

    public function store(Request $request): mixed
    {
        // teria que fazer uma valida dos dados
        return Anuncio::create($request->toArray());
    }

    public function destroy(string $id): mixed
    {
        $anuncio = Anuncio::findOrFail($id);

        if (!$anuncio) {
            return response()->json(status: 404);
        }

        $anuncio->delete();

        return response()->json(status: 204);
    }
}

// php artisan migrate
