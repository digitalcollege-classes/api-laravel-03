<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CategoryApiTest extends TestCase
{
    //caminho feliz
    public function test_que_o_endpoint_de_buscar_categorias_funciona(): void
    {
        $response = $this->get('/api/categorias');

        $response->assertSuccessful(); //200

        $json = $response->json();

        $this->assertIsArray($json); //redundante / garantindo que o conteudo do json é um array
        $this->assertCount(1, $json); //que o conteudo do array só tem X elemento(s)
        $this->assertIsInt($json[0]['id']); // redundante

        $this->assertIsString($json[0]['nome']);

        $this->assertEquals([
            'id' => 1,
            'nome' => 'Carros suados',
        ], $json[0]);
    }
}
// php artisan test
