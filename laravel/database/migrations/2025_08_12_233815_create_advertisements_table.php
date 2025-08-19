<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertiser_id');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['active', 'paused', 'sold', 'inactive'])->default('active');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['status']);
            $table->index('advertiser_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};