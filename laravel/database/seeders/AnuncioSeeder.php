<?php

namespace Database\Seeders;

use App\Models\Anuncio;
use Illuminate\Database\Seeder;

class AnuncioSeeder extends Seeder
{
    public function run(): void
    {
        $anuncios = [
            [
                'titulo' => 'Corola 2012 - Unico Dono',
                'descricao' => '',
                'preco' => 48980.89,
            ],
            [
                'titulo' => 'Vestido longo de festa',
                'descricao' => 'Vestido para pessoal exigente',
                'preco' => 2989.19,
            ],
        ];

        foreach ($anuncios as $anuncio) {
            Anuncio::create($anuncio);
        }
    }
}
