<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakKamiController;

/*
|--------------------------------------------------------------------------
| Web Routes - Rute Aplikasi Web PT Solusi Koneksi Anda
|--------------------------------------------------------------------------
| File ini mendefinisikan seluruh rute (URL) yang dapat diakses oleh
| pengunjung publik maupun administrator sistem yang telah login.
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. RUTE PENGUNJUNG PUBLIK (Landing Page)
// =========================================================================

// Menampilkan halaman utama landing page (profil, produk, artikel, galeri, form kontak)
Route::get('/', [PublicController::class, 'index'])->name('home');

// Menerima kiriman form kontak dari pengunjung publik (metode POST)
Route::post('/kirim-pesan', [KontakKamiController::class, 'kirim'])->name('kontak.kirim');


// =========================================================================
// 2. RUTE AUTENTIKASI ADMIN (Login & Logout)
// =========================================================================

// Menampilkan halaman antarmuka form login admin (metode GET)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Memproses verifikasi username & kata sandi dari form login (metode POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Mengeluarkan admin dari sesi aktif / menghapus sesi (metode POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================================================================
// 3. PANEL ADMINISTRASI (Wajib Login - Dilindungi Middleware 'auth')
// =========================================================================

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware('auth')->prefix('admin')->group(function () {

    // Akses rute /admin langsung dialihkan ke dashboard admin
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Halaman Dashboard ringkasan statistik data (Jumlah produk, artikel, galeri, kontak)
    Route::get('/dashboard', function () {
        return view('admin.Dashboard');
    })->name('admin.dashboard');

    // Pengelolaan Profil Perusahaan (Hanya Edit dan Simpan Perubahan)
    Route::get('/profil', [ProfilController::class, 'edit'])->name('admin.profil.edit');
    Route::put('/profil/{id}', [ProfilController::class, 'update'])->name('admin.profil.update');

    // Rute Resource CRUD Lengkap (index, create, store, edit, update, destroy)
    // Otomatis menyediakan 7 rute standar RESTful Laravel:
    Route::resource('produk', ProdukController::class);   // Kelola Katalog Produk & Layanan
    Route::resource('artikel', ArtikelController::class); // Kelola Artikel & Wawasan Berita
    Route::resource('galeri', GaleriController::class);   // Kelola Galeri Foto Kegiatan

    // Pengelolaan Kotak Masuk Pesan Pelanggan
    Route::get('/kelola-kontak-kami', [KontakKamiController::class, 'index'])->name('admin.kontak.index');
    Route::delete('/kelola-kontak-kami/{id}', [KontakKamiController::class, 'destroy'])->name('admin.kontak.destroy');
});