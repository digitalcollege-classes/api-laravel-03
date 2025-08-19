<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class AnunciosApiTest extends TestCase
{
    use RefreshDatabase;

    public function testEndpointQueBuscaTodosOsAnuncios(): void
    {
        //rodando a seed antes de executar o teste
        $this->seed();

        $response = $this->get('/api/anuncios');

        $dados = $response->json();

        $response->assertStatus(200);
        $this->assertEquals(2, count($dados));
        $this->assertEquals('Corola 2012 - Unico Dono', $dados[0]['titulo']);
    }

    public function testEndpointQueBuscaUmEDeveriaRetornarNotFound(): void
    {
        //rodando a seed antes de executar o teste
        $this->seed();

        $response = $this->get('/api/anuncios/9999');

        $response->assertStatus(404);
    }
}
