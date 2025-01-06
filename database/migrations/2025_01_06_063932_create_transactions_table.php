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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cabang');
            $table->unsignedBigInteger('id_kasir');
            $table->decimal('total_harga', 10, 2);
            $table->integer('total_produk');
            $table->date('tanggal_transaksi');

            $table->foreign('id_cabang')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('id_kasir')->references('id')->on('update_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
