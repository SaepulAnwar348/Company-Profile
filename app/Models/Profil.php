<?php

namespace App\Models;

// Mengimpor trait HasFactory untuk pembuatan dummy data pengujian
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Mengimpor class Model dasar Eloquent ORM dari Laravel
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    // Mengaktifkan fitur factory bawaan Eloquent
    use HasFactory;

    // Menentukan nama tabel di database yang terhubung dengan model ini
    protected $table = 'profils';

    // Menentukan primary key tabel karena nama kolomnya kustom (bukan kolom 'id' biasa)
    protected $primaryKey = 'id_profil';

    // Kolom-kolom yang diizinkan untuk diisi secara massal (mass assignment) saat proses update profil
    protected $fillable = [
        'nama_perusahaan', // Nama resmi atau badan usaha perusahaan (PT Solusi Koneksi Anda)
        'tentang_kami',    // Paragraf deskripsi profil singkat dan latar belakang perusahaan
        'visi',            // Visi perusahaan ke depan
        'misi',            // Poin-poin misi perusahaan
        'alamat',          // Alamat kantor operasional perusahaan
        'email',           // Alamat email resmi untuk korespondensi pelanggan
        'no_hp',           // Nomor telepon / nomor kontak WhatsApp resmi
    ];
}