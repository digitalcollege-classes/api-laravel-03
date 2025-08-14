<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrinho_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrinho_id')->constrained('carrinhos')->onDelete('cascade');
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->integer('quantidade')->default(1);
            $table->decimal('preco_unitario', 10, 2);
            $table->timestamps();

            // Evita duplicação do mesmo produto no mesmo carrinho
            $table->unique(['carrinho_id', 'produto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrinho_produtos');
    }
};
