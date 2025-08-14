<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class ShoppingCartController extends Controller
{
    public function getAll(): mixed
    {
        $categorias = [
            [
                'nome' => 'Carros usados',
                'quantidade' => '1',
                'valor' => '10000',
                'valor total dos produtos' => 'R$ 10000',
                'total a prazo' => 'R$ 10000 (em até 10x de R$ 100 sem juros)',
                'valor a vista mo pix' => 'R$ 9000 (economize R$ 1000)',
            ],
        ];

        return $categorias;
    }
}
