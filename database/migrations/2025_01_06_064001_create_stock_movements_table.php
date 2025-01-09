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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cabang');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('user_id');
            $table->enum('movement_type', ['in', 'out']);
            $table->integer('jumlah');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_perubahan');

            $table->foreign('id_cabang')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('update_users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
