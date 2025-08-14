<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Busca as categorias criadas
        $electronics = Category::where('nome', 'Eletrônicos')->first();
        $clothes = Category::where('nome', 'Roupas')->first();
        $home = Category::where('nome', 'Casa e Jardim')->first();
        $books = Category::where('nome', 'Livros')->first();
        $sports = Category::where('nome', 'Esportes')->first();

        $products = [
            // Eletrônicos
            [
                'nome' => 'Smartphone Samsung Galaxy S23',
                'descricao' => 'Smartphone com câmera de 50MP e 128GB de armazenamento',
                'preco' => 2599.99,
                'categoria_id' => $electronics->id,
            ],
            [
                'nome' => 'Notebook Dell Inspiron',
                'descricao' => 'Notebook com Intel i5, 8GB RAM e SSD 256GB',
                'preco' => 2899.90,
                'categoria_id' => $electronics->id,
            ],
            [
                'nome' => 'Fone de Ouvido Bluetooth',
                'descricao' => 'Fone wireless com cancelamento de ruído',
                'preco' => 299.99,
                'categoria_id' => $electronics->id,
            ],

            // Roupas
            [
                'nome' => 'Camiseta Polo Masculina',
                'descricao' => 'Camiseta polo 100% algodão, tamanho M',
                'preco' => 89.90,
                'categoria_id' => $clothes->id,
            ],
            [
                'nome' => 'Vestido Feminino Floral',
                'descricao' => 'Vestido longo floral, tamanho P',
                'preco' => 159.90,
                'categoria_id' => $clothes->id,
            ],

            // Casa e Jardim
            [
                'nome' => 'Jogo de Panelas Antiaderente',
                'descricao' => 'Conjunto com 5 panelas antiaderente',
                'preco' => 199.90,
                'categoria_id' => $home->id,
            ],
            [
                'nome' => 'Aspirador de Pó Robot',
                'descricao' => 'Aspirador automático com mapeamento inteligente',
                'preco' => 899.99,
                'categoria_id' => $home->id,
            ],

            // Livros
            [
                'nome' => 'Clean Code - Código Limpo',
                'descricao' => 'Livro sobre boas práticas de programação',
                'preco' => 79.90,
                'categoria_id' => $books->id,
            ],
            [
                'nome' => 'O Hobbit',
                'descricao' => 'Clássico da literatura fantástica',
                'preco' => 45.90,
                'categoria_id' => $books->id,
            ],

            // Esportes
            [
                'nome' => 'Bicicleta Mountain Bike',
                'descricao' => 'Bicicleta aro 29 com 21 marchas',
                'preco' => 1299.99,
                'categoria_id' => $sports->id,
            ],
            [
                'nome' => 'Kit de Musculação',
                'descricao' => 'Kit com halteres e barras ajustáveis',
                'preco' => 459.90,
                'categoria_id' => $sports->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
