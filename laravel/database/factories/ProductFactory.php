<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->words(3, true),
            'descricao' => $this->faker->paragraph(),
            'preco' => $this->faker->randomFloat(2, 10, 1000),
            'categoria_id' => Category::factory(),
        ];
    }
}
