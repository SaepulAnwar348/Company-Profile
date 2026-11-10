<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Produk;
use App\Models\Artikel;
use App\Models\Galeri;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman beranda publik (Landing Page).
     * Mengambil data profil perusahaan, daftar produk, artikel terbaru, dan galeri kegiatan
     * dari database untuk ditampilkan kepada pengunjung umum.
     */
    public function index() 
    {
        // Mengambil data profil perusahaan pertama (statis id=1)
        $profil = Profil::first();

        // Mengambil seluruh daftar produk dan layanan jaringan
        $produk = Produk::all();

        // Mengambil seluruh artikel berita yang diurutkan dari yang paling baru
        $artikel = Artikel::latest()->get();

        // Mengambil seluruh galeri foto dokumentasi kegiatan
        $galeri = Galeri::all();

        // Mengirimkan seluruh variabel data ke file view resources/views/public/index.blade.php
        return view('public.index', compact('profil', 'produk', 'artikel', 'galeri'));
    }
}