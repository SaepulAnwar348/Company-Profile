<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Data katalog perangkat/layanan dinamis
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id_produk'); // Primary Key
            $table->string('nama_produk', 150); // Nama barang/layanan
            $table->text('deskripsi'); // Penjelasan teknis
            $table->decimal('harga', 12, 2); // Tarif/harga produk
            $table->string('gambar', 255)->nullable(); // Foto produk
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('produks');
    }
};