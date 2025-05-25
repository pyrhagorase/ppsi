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
        Schema::create('servis', function (Blueprint $table) {
            $table->id(); // primary key auto-increment
            $table->string('id_tracking')->unique(); // kode unik tracking
            $table->string('nama_pelanggan');
            $table->string('kontak'); // bisa nomor HP atau email
            $table->timestamp('waktu_servis'); // waktu servis dilakukan
            $table->string('tipe_barang'); // misalnya: laptop, hp
            $table->text('kerusakan'); // deskripsi kerusakan, bisa panjang
            $table->string('biaya')->nullable(); 
            $table->enum('status_pembayaran', ['Belum Lunas', 'Lunas'])->default('Belum Lunas');
            $table->text('keterangan')->nullable(); // opsional
            $table->enum('statusservis', ['Menunggu','KonfirmasiBiaya', 'Diproses', 'Selesai', 'Lunas'])->default('Menunggu');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};