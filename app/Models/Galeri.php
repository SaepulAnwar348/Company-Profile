<?php

namespace App\Models;

// Mengimpor trait HasFactory untuk pembuatan dummy data pengujian
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Mengimpor class Model dasar Eloquent ORM dari Laravel
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    // Mengaktifkan fitur factory bawaan Eloquent
    use HasFactory;

    // Menentukan nama tabel di database yang terhubung dengan model ini
    protected $table = 'galeris';

    // Menentukan primary key tabel karena nama kolomnya kustom (bukan kolom 'id' biasa)
    protected $primaryKey = 'id_galeri';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (mass assignment) pada fitur CRUD Galeri
    protected $fillable = [
        'judul',  // Keterangan / judul foto kegiatan atau dokumentasi proyek
        'gambar', // Path penyimpanan file foto kegiatan di storage public
    ];
}