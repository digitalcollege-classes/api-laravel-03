<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisementSeeder extends Seeder
{
    public function run(): void
    {
        $advertisements = [
            // iPhone 13 Pro (product_id: 1)
            [
                'advertiser_id' => 1,
                'product_id' => 1,
                'title' => 'iPhone 13 Pro 256GB - Estado de Novo!',
                'description' => 'Vendo iPhone 13 Pro usado apenas 6 meses, sem arranhões, com caixa e carregador original. Aceito cartão.',
                'price' => 3100.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Samsung Galaxy S21 (product_id: 2)
            [
                'advertiser_id' => 2,
                'product_id' => 2,
                'title' => 'Galaxy S21 Lacrado - Promoção!',
                'description' => 'Samsung Galaxy S21 lacrado, nota fiscal, garantia de 1 ano. Última unidade com desconto especial.',
                'price' => 1750.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Notebook Dell (product_id: 3)
            [
                'advertiser_id' => 3,
                'product_id' => 3,
                'title' => 'Notebook Dell i5 - Ideal para Trabalho',
                'description' => 'Dell Inspiron reformado, perfeito para estudos e trabalho. Bateria nova, Windows 11 original instalado.',
                'price' => 2400.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Honda Civic (product_id: 4)
            [
                'advertiser_id' => 4,
                'product_id' => 4,
                'title' => 'Honda Civic 2018 - Único Dono',
                'description' => 'Civic LXR completíssimo, único dono, revisões em dia na concessionária. Aceito financiamento.',
                'price' => 82000.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Yamaha Factor (product_id: 5)
            [
                'advertiser_id' => 1,
                'product_id' => 5,
                'title' => 'Factor 125 - Econômica e Conservada',
                'description' => 'Moto muito econômica, ideal para trabalho. Documentos ok, pneus novos.',
                'price' => 7200.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sofá 3 Lugares (product_id: 6)
            [
                'advertiser_id' => 5,
                'product_id' => 6,
                'title' => 'Sofá Retrátil 3 Lugares - Oportunidade!',
                'description' => 'Sofá muito confortável, pouco uso, sem pets, sem fumantes. Entrego na região.',
                'price' => 1100.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Geladeira Brastemp (product_id: 7)
            [
                'advertiser_id' => 6,
                'product_id' => 7,
                'title' => 'Geladeira Brastemp Nova - Lacrada',
                'description' => 'Geladeira nova, lacrada, nota fiscal. Comprei e não coube na cozinha. Pago frete.',
                'price' => 2700.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Bicicleta Caloi (product_id: 8)
            [
                'advertiser_id' => 2,
                'product_id' => 8,
                'title' => 'Bike Caloi Elite - Seminova',
                'description' => 'Bicicleta em ótimo estado, usada apenas finais de semana. Inclui capacete e luvas.',
                'price' => 1400.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Tênis Nike (product_id: 9)
            [
                'advertiser_id' => 3,
                'product_id' => 9,
                'title' => 'Nike Air Max Original - Pouco Uso',
                'description' => 'Tênis original, comprado na Nike, usado poucas vezes. Tamanho 42, cor branca e azul.',
                'price' => 320.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Livro PHP (product_id: 10)
            [
                'advertiser_id' => 7,
                'product_id' => 10,
                'title' => 'Livro PHP Moderno - Novo',
                'description' => 'Livro novo, ainda lacrado. Ideal para quem está aprendendo programação PHP.',
                'price' => 75.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Jaqueta Levis (product_id: 11)
            [
                'advertiser_id' => 4,
                'product_id' => 11,
                'title' => 'Jaqueta Jeans Levis Clássica',
                'description' => 'Jaqueta Levis original, tamanho M, cor tradicional. Peça atemporal, combina com tudo.',
                'price' => 160.00,
                'status' => 'active',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Anúncios com status diferentes
            [
                'advertiser_id' => 5,
                'product_id' => 1, // iPhone novamente (outro anúncio)
                'title' => 'iPhone 13 Pro - VENDIDO',
                'description' => 'Este anúncio já foi vendido.',
                'price' => 3200.00,
                'status' => 'sold',
                'published_at' => now()->subDays(5),
                'created_at' => now()->subDays(7),
                'updated_at' => now(),
            ],

            [
                'advertiser_id' => 6,
                'product_id' => 4, // Honda Civic novamente
                'title' => 'Civic 2018 - Anúncio Pausado',
                'description' => 'Anúncio temporariamente pausado.',
                'price' => 85000.00,
                'status' => 'paused',
                'published_at' => now()->subDays(3),
                'created_at' => now()->subDays(10),
                'updated_at' => now(),
            ]
        ];

        DB::table('advertisements')->insert($advertisements);
    }
}