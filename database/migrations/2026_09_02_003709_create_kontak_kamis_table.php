<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Data formulir Kontak Kami dari pengunjung web
        Schema::create('kontak_kamis', function (Blueprint $table) {
            $table->id('id_kontak'); // Primary Key
            $table->string('nama_pengirim', 100); // Nama publik
            $table->string('email_pengirim', 150); // Email publik
            $table->string('subjek', 100); // Topik bahasan
            $table->text('isi_pesan'); // Isi pertanyaan/kebutuhan
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kontak_kamis');
    }
};