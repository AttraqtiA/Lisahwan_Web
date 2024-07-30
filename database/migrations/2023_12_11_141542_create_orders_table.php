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
            $table->unsignedBigInteger('midtrans_order_id')->nullable(true);
            $table->dateTime('order_date')->nullable(false);
            $table->dateTime('shipment_date')->nullable(true);
            $table->dateTime('arrived_date')->nullable(true);
            $table->bigInteger('total_price')->nullable(false);
            $table->integer('total_weight')->nullable(false);
            // metode pembayaran (online -> midtrans/qris atau cash)
            $table->string('payment')->nullable(true);
            $table->string('waybill')->nullable(true);
            $table->string('note')->nullable(true);
            $table->string('shipment_service')->nullable(true);
            $table->string('shipment_estimation')->nullable(true);
            // ngga dipakai
            $table->enum('is_print', ['pending', 'sudah'])->default('pending');
            //otomatis dari RAJAONGKIR (status sesuai rajaongkir)
            $table->string('shipment_status')->default('pending');
            //otomatis dari MIDTRANS (status sesuai midtrans)
            $table->string('acceptbyAdmin_status')->default('unpaid');
            // otomatis dari RAJAONGKIR
            $table->enum('acceptbyCustomer_status', ['pending', 'sudah'])->default('pending');
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
