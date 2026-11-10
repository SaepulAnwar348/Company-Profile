<?php

namespace App\Models;

// Mengimpor trait HasFactory untuk pembuatan dummy data pengujian
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Mengimpor class Model dasar Eloquent ORM dari Laravel
use Illuminate\Database\Eloquent\Model;

class KontakKami extends Model
{
    // Mengaktifkan fitur factory bawaan Eloquent
    use HasFactory;

    // Menentukan nama tabel di database yang terhubung dengan model ini
    protected $table = 'kontak_kamis';

    // Menentukan primary key tabel karena nama kolomnya kustom (bukan kolom 'id' biasa)
    protected $primaryKey = 'id_kontak';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (mass assignment) saat pengunjung mengirim pesan
    protected $fillable = [
        'nama_pengirim',  // Nama lengkap pengunjung yang mengisi formulir kontak
        'email_pengirim', // Alamat email pengunjung untuk dihubungi kembali
        'subjek',         // Topik perihal kebutuhan konsultasi / pemesanan
        'isi_pesan',      // Uraian rincian pertanyaan atau pesan dari pengunjung
    ];
}