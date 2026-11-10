<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Konten artikel / informasi terkini dinamis
        Schema::create('artikels', function (Blueprint $table) {
            $table->id('id_artikel'); // Primary Key
            $table->string('judul', 250); // Judul artikel informasi
            $table->text('isi_artikel'); // Isi berita komprehensif
            $table->string('penulis', 100); // Nama penulis
            $table->string('gambar', 250)->nullable(); // Gambar ilustrasi
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('artikels');
    }
};