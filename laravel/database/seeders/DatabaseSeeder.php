<?php

namespace Database\Seeders;

use App\Models\Anuncio;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AnuncioSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
