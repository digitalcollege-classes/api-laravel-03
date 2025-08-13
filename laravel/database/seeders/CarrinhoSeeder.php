<?php

namespace Database\Seeders;

use App\Models\Carrinho;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarrinhoSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário se não existir
        $user = User::firstOrCreate(
            ['email' => 'teste@teste.com'],
            [
                'name' => 'Usuário Teste',
                'password' => bcrypt('123456')
            ]
        );

        Carrinho::create([
            'user_id' => $user->id,
            'produto_id' => 1,
            'quantidade' => 1
        ]);

        Carrinho::create([
            'user_id' => $user->id,
            'produto_id' => 2,
            'quantidade' => 2
        ]);

        Carrinho::create([
            'user_id' => $user->id,
            'produto_id' => 3,
            'quantidade' => 3
        ]);
    }
}
