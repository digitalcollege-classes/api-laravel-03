<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        
        //vai executar as migrations do banco
        $this->artisan('migrate');

        //vai gerar os dados falsos do banco
        $this->seed();
    }
}
