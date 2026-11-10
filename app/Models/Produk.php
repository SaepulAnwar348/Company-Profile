<?php

namespace App\Models;

// Mengimpor trait HasFactory untuk pembuatan dummy data pengujian
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Mengimpor class Model dasar Eloquent ORM dari Laravel
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Mengaktifkan fitur factory bawaan Eloquent
    use HasFactory;

    // Menentukan nama tabel di database yang terhubung dengan model ini
    protected $table = 'produks';

    // Menentukan primary key tabel karena nama kolomnya kustom (bukan kolom 'id' biasa)
    protected $primaryKey = 'id_produk';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (mass assignment) pada fitur CRUD Produk
    protected $fillable = [
        'nama_produk', // Nama barang perangkat keras atau paket layanan jaringan
        'deskripsi',   // Uraian rincian spesifikasi teknis atau rincian layanan
        'harga',       // Nilai harga atau tarif jasa (tipe data desimal / angka)
        'gambar',      // Path penyimpanan file gambar/foto produk di storage public
    ];
}