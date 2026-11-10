<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Profil perusahaan (Statis/hanya diedit, tidak bisa tambah baru)
        Schema::create('profils', function (Blueprint $table) {
            $table->id('id_profil'); // Primary Key
            $table->string('nama_perusahaan', 250); // Nama legal entitas
            $table->text('tentang_kami'); // Uraian profil
            $table->text('visi'); // Visi
            $table->text('misi'); // Misi
            $table->text('alamat'); // Alamat kantor Bogor
            $table->string('email', 150); // Email korespondensi
            $table->string('no_hp', 15); // Nomor telepon resmi
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('profils');
    }
};