<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Galeri kegiatan perusahaan dinamis
        Schema::create('galeris', function (Blueprint $table) {
            $table->id('id_galeri'); // Primary Key
            $table->string('judul', 150); // Judul dokumentasi acara
            $table->string('gambar', 255); // File foto dokumentasi
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('galeris');
    }
};