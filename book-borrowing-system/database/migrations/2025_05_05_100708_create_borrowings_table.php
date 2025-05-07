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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->foreignId('id_user')->constrained('users', 'id');
            $table->foreignId('id_buku')->constrained('books', 'id_buku');
            $table->dateTime('tanggal_pinjam');
            $table->dateTime('tanggal_kembali');
            $table->enum('status', ['dipinjam', 'dikembalikan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
