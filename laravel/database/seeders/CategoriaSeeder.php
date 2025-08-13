<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create([
            'nome' => 'Eletrônicos',
            'descricao' => 'Produtos eletrônicos e tecnologia'
        ]);

        Categoria::create([
            'nome' => 'Roupas',
            'descricao' => 'Vestuário e acessórios'
        ]);

        Categoria::create([
            'nome' => 'Casa',
            'descricao' => 'Produtos para casa e decoração'
        ]);
    }
}
