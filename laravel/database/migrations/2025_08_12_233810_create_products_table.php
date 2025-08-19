<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('brand', 50)->nullable();
            $table->enum('condition', ['new', 'used', 'refurbished'])->default('new');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['category_id', 'is_active']);
            $table->index(['price']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};