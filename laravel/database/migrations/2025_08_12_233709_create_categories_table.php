<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->timestamp('created_at')->nullable();      
            $table->timestamp('updated_at')->nullable();          
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
