<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create the pivot table
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->timestamps();
        });

        // 2. Migrate existing category data to the pivot table
        DB::statement('INSERT INTO category_product (product_id, category_id, created_at, updated_at) SELECT id, category_id, NOW(), NOW() FROM products WHERE category_id IS NOT NULL');

        // 3. Remove the old category_id column from products
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
        });

        // Try to restore the first category back to products table
        DB::statement('UPDATE products p SET category_id = (SELECT category_id FROM category_product cp WHERE cp.product_id = p.id LIMIT 1)');

        Schema::dropIfExists('category_product');
    }
};
