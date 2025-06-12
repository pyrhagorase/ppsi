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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('id_tracking'); // referensi ke tabel servis
            $table->date('tanggal');
            $table->string('kasir'); // bisa juga pakai foreign key ke users
            $table->enum('status', ['Lunas', 'Belum Lunas', 'DP']);
            $table->enum('metode_bayar', ['Cash', 'Transfer', 'QRIS']);
            $table->integer('total'); // total harga semua item
            $table->integer('dibayar');
            $table->integer('kembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
