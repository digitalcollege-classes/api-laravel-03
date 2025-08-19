<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Eletrônicos',
                'description' => 'Smartphones, tablets, notebooks, computadores e acessórios eletrônicos',
                'image_path' => 'categories/eletronicos.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Veículos',
                'description' => 'Carros, motos, caminhões e outros veículos',
                'image_path' => 'categories/veiculos.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Casa e Jardim',
                'description' => 'Móveis, decoração, eletrodomésticos e itens para casa',
                'image_path' => 'categories/casa-jardim.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Esportes',
                'description' => 'Equipamentos esportivos, roupas e acessórios para atividades físicas',
                'image_path' => 'categories/esportes.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Livros e Educação',
                'description' => 'Livros, cursos, material escolar e educacional',
                'image_path' => 'categories/livros.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Moda',
                'description' => 'Roupas, calçados, acessórios e artigos de moda',
                'image_path' => 'categories/moda.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}