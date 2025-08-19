<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // ELETRÔNICOS (category_id: 1)
            [
                'category_id' => 1,
                'name' => 'iPhone 13 Pro',
                'description' => 'Smartphone Apple iPhone 13 Pro 256GB, câmera tripla, tela Super Retina XDR',
                'brand' => 'Apple',
                'condition' => 'used',
                'price' => 3200.00,
                'image_path' => 'products/iphone13pro.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Samsung Galaxy S21',
                'description' => 'Smartphone Samsung Galaxy S21 128GB, câmera 64MP, 5G',
                'brand' => 'Samsung',
                'condition' => 'new',
                'price' => 1800.00,
                'image_path' => 'products/galaxys21.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Notebook Dell Inspiron',
                'description' => 'Notebook Dell Inspiron 15, Intel i5, 8GB RAM, SSD 256GB',
                'brand' => 'Dell',
                'condition' => 'refurbished',
                'price' => 2500.00,
                'image_path' => 'products/dell-inspiron.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // VEÍCULOS (category_id: 2)
            [
                'category_id' => 2,
                'name' => 'Honda Civic 2018',
                'description' => 'Honda Civic LXR 2.0, automático, completo, baixa quilometragem',
                'brand' => 'Honda',
                'condition' => 'used',
                'price' => 85000.00,
                'image_path' => 'products/honda-civic.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Yamaha Factor 125',
                'description' => 'Moto Yamaha Factor 125cc, partida elétrica, baixo consumo',
                'brand' => 'Yamaha',
                'condition' => 'used',
                'price' => 7500.00,
                'image_path' => 'products/yamaha-factor.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // CASA E JARDIM (category_id: 3)
            [
                'category_id' => 3,
                'name' => 'Sofá 3 Lugares',
                'description' => 'Sofá retrátil e reclinável 3 lugares, tecido suede, cor cinza',
                'brand' => 'Tok Stok',
                'condition' => 'used',
                'price' => 1200.00,
                'image_path' => 'products/sofa-3lugares.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Geladeira Brastemp',
                'description' => 'Geladeira Brastemp Frost Free 400L, duplex, inox',
                'brand' => 'Brastemp',
                'condition' => 'new',
                'price' => 2800.00,
                'image_path' => 'products/geladeira-brastemp.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ESPORTES (category_id: 4)
            [
                'category_id' => 4,
                'name' => 'Bicicleta Caloi Elite',
                'description' => 'Bicicleta Caloi Elite Carbon Sport, 21 marchas, aro 29',
                'brand' => 'Caloi',
                'condition' => 'used',
                'price' => 1500.00,
                'image_path' => 'products/caloi-elite.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'name' => 'Tênis Nike Air Max',
                'description' => 'Tênis Nike Air Max 90, original, tamanho 42, pouco uso',
                'brand' => 'Nike',
                'condition' => 'used',
                'price' => 350.00,
                'image_path' => 'products/nike-airmax.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // LIVROS E EDUCAÇÃO (category_id: 5)
            [
                'category_id' => 5,
                'name' => 'Livro PHP Moderno',
                'description' => 'Livro completo sobre desenvolvimento PHP moderno, autor brasileiro',
                'brand' => 'Casa do Código',
                'condition' => 'new',
                'price' => 89.90,
                'image_path' => 'products/livro-php.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // MODA (category_id: 6)
            [
                'category_id' => 6,
                'name' => 'Jaqueta Jeans Levis',
                'description' => 'Jaqueta jeans Levis clássica, tamanho M, cor azul escuro',
                'brand' => 'Levis',
                'condition' => 'used',
                'price' => 180.00,
                'image_path' => 'products/jaqueta-levis.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('products')->insert($products);
    }
}