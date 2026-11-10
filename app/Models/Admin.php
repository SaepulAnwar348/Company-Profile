<?php

namespace App\Models;

// Mengimpor trait HasFactory untuk mempermudah pembuatan dummy data pengujian
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Mengimpor class Authenticatable agar model ini dapat digunakan pada sistem autentikasi / login Laravel (Auth guard)
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Mengaktifkan fitur factory bawaan Eloquent
    use HasFactory;

    // Menentukan nama tabel di database yang terhubung dengan model ini
    protected $table = 'admins';

    // Menentukan primary key tabel karena nama kolomnya kustom (bukan kolom 'id' biasa)
    protected $primaryKey = 'id_admin';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (mass assignment) melalui form / create()
    protected $fillable = [
        'username',     // Username untuk keperluan login admin ke sistem
        'password',     // Kata sandi admin yang telah dienkripsi dengan Hash (Bcrypt)
        'nama_lengkap', // Nama lengkap pengelola / administrator sistem
    ];

    // Kolom yang disembunyikan saat data model diubah menjadi array atau JSON (keamanan data)
    protected $hidden = [
        'password',     // Menyembunyikan password agar tidak bocor keluar sistem
    ];
}