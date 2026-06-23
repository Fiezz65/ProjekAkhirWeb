<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->unsignedBigInteger('id_users');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali_plan');
            $table->date('tgl_kembali_asli')->nullable();
            $table->enum('status', ['Menunggu', 'Dipinjam', 'Dikembalikan', 'Ditolak'])->default('Menunggu');
            $table->timestamps();

            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
