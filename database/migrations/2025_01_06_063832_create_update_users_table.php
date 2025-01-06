<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('update_users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user');
            $table->string('peran');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_cabang')->nullable();
            $table->foreign('id_cabang')->references('id')->on('branches')->onDelete('cascade');
            $table->rememberToken();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_users');
    }
};
