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
        Schema::create('my_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->string('id_tracking'); // Foreign key ke tabel servis
            $table->timestamps();

            // Index dan foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_tracking')->references('id_tracking')->on('servis')->onDelete('cascade');
            
            // Pastikan user tidak bisa menyimpan tracking ID yang sama lebih dari sekali
            $table->unique(['user_id', 'id_tracking']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_services');
    }
};