<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function getAll(): mixed
    {
        $categorias = [
            [
                'id' => 1,
                'ano' => '2021',
                'cor' => 'Carro branco',
                'quilometragem' => '54545445',
                'potencia do motor' => '1.0',
                'combustivel' => 'flex',
                'câmbio' => 'manual',
                'modelo' => 'chevrolet Hatch Lt 1.0 8v Flexpower',
                'marca' => 'chevrolet',
                'potencia do moto' => '1.0',
                'direção' => 'Elétrica',
                'portas' => '4 portas',
                'final da placa' => '5',
                'possui kit GNV' => 'não',
            ],
        ];

        return $categorias;
    }
}
