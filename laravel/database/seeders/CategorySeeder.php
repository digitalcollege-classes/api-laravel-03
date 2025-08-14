<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nome' => 'Eletrônicos',
                'descricao' => 'Produtos eletrônicos em geral',
            ],
            [
                'nome' => 'Roupas',
                'descricao' => 'Vestuário masculino e feminino',
            ],
            [
                'nome' => 'Casa e Jardim',
                'descricao' => 'Produtos para casa e jardim',
            ],
            [
                'nome' => 'Livros',
                'descricao' => 'Livros de todas as categorias',
            ],
            [
                'nome' => 'Esportes',
                'descricao' => 'Artigos esportivos',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
