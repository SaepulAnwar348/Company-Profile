<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Tabel kredensial admin sistem
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin'); // Primary Key
            $table->string('username', 50)->unique(); // Username unik
            $table->string('password', 255); // Password terenkripsi
            $table->string('nama_lengkap', 100); // Identitas pengelola
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('admins');
    }
};