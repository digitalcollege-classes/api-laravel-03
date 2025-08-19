<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Anuncio;

class AnuncioRepository
{
    public function findAll(): mixed
    {
        return Anuncio::all(['titulo']);
    }
}