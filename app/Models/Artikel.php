<?php

namespace App\Models;

// Mengimpor trait HasFactory untuk pembuatan dummy data pengujian
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Mengimpor class Model dasar Eloquent ORM dari Laravel
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    // Mengaktifkan fitur factory bawaan Eloquent
    use HasFactory;

    // Menentukan nama tabel di database yang terhubung dengan model ini
    protected $table = 'artikels';

    // Menentukan primary key tabel karena nama kolomnya kustom (bukan kolom 'id' biasa)
    protected $primaryKey = 'id_artikel';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (mass assignment) pada fitur CRUD Artikel
    protected $fillable = [
        'judul',       // Judul artikel atau berita seputar teknologi & jaringan
        'isi_artikel', // Isi teks lengkap artikel
        'penulis',     // Nama pembuat / penulis artikel
        'gambar',      // Path penyimpanan file banner/sampul artikel di storage public
    ];
}