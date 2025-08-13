<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::create([
            'nome' => 'Notebook Dell',
            'descricao' => 'Notebook Dell Inspiron 15',
            'preco' => 2500.00,
            'categoria_id' => 1
        ]);

        Produto::create([
            'nome' => 'Mouse Gamer',
            'descricao' => 'Mouse gamer RGB',
            'preco' => 150.00,
            'categoria_id' => 1
        ]);

        Produto::create([
            'nome' => 'Camiseta',
            'descricao' => 'Camiseta básica algodão',
            'preco' => 49.90,
            'categoria_id' => 2
        ]);

        Produto::create([
            'nome' => 'Sofá',
            'descricao' => 'Sofá 3 lugares',
            'preco' => 899.00,
            'categoria_id' => 3
        ]);
    }
}
