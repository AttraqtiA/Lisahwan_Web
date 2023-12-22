<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);
            $table->bigInteger('price')->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->integer('weight')->nullable(false);
            $table->integer('discount')->nullable(true)->default(0);
            $table->enum('favorite_status', ['0', '1'])->default('0');
            $table->string('image')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
