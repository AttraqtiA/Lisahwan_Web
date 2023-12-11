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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->date('order_date')->nullable(false);
            $table->date('shipment_date')->nullable(false);
            $table->bigInteger('total_price')->nullable(false);
            $table->integer('total_weight')->nullable(false);
            $table->string('payment')->nullable(false);
            $table->string('note')->nullable(true);
            $table->enum('is_print', ['0', '1'])->default('0');
            $table->enum('shipment_status', ['0', '1'])->default('0');
            $table->enum('acceptbyAdmin_status', ['0', '1'])->default('0');
            $table->enum('acceptbyCustomer_status', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
