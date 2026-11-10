<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Admin;
use App\Models\Profil;
use App\Models\Produk;
use App\Models\Artikel;
use App\Models\Galeri;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Buat akun admin default untuk login evaluasi jika belum ada
        if (!Admin::where('username', 'admin')->exists()) {
            Admin::create([
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'nama_lengkap' => 'Administrator'
            ]);
        }

        // Profil default PT Solusi Koneksi Anda (Produk & Layanan Jaringan)
        Profil::updateOrCreate(
            ['id_profil' => 1],
            [
                'nama_perusahaan' => 'PT Solusi Koneksi Anda',
                'tentang_kami' => 'PT Solusi Koneksi Anda adalah penyedia solusi infrastruktur IT dan jaringan terintegrasi, melayani pengadaan perangkat digital, instalasi jaringan WiFi & LAN, fiber optic, hingga pemeliharaan sistem IT korporat.',
                'visi' => 'Menjadi mitra utama penyedia produk hardware dan layanan infrastruktur jaringan IT terdepan, andal, dan inovatif di Indonesia.',
                'misi' => 'Menyediakan perangkat jaringan berkualitas tinggi bergaransi resmi serta menghadirkan layanan instalasi WiFi, integrasi sistem, dan dukungan teknis purna jual 24/7.',
                'alamat' => 'Jl. Raya Pajajaran No. 88 F Kota Bogor 16153',
                'email' => 'info@solusikoneksi.co.id',
                'no_hp' => '0251-8321999'
            ]
        );

        // Pastikan folder direktori upload publik tersedia
        $paths = [
            storage_path('app/public/produk'),
            storage_path('app/public/artikel'),
            storage_path('app/public/galeri'),
        ];
        foreach ($paths as $path) {
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true, true);
            }
        }

        // Pastikan storage symlink / junction terhubung ke public/storage
        if (!file_exists(public_path('storage'))) {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
        }

        // Copy source foto3 jika tersedia
        $sampleImg = resource_path('img/foto3.png');

        // Helper untuk download / copy fallback image
        $setupImage = function($url, $storageRelPath) use ($sampleImg) {
            $dest1 = storage_path('app/public/' . $storageRelPath);
            if (!File::exists($dest1)) {
                $content = @file_get_contents($url);
                if ($content !== false && strlen($content) > 1000) {
                    File::put($dest1, $content);
                } elseif (File::exists($sampleImg)) {
                    File::copy($sampleImg, $dest1);
                }
            }
        };

        // Download / Copy Gambar Produk (Foto produk nyata / non-AI)
        $setupImage('https://images.unsplash.com/photo-1750712263185-edde9f359e33?w=800&auto=format&fit=crop&q=80', 'produk/router-wifi.jpg');
        $setupImage('https://images.unsplash.com/photo-1750711158632-5273ec9b9b86?w=800&auto=format&fit=crop&q=80', 'produk/switch-hub.jpg');
        $setupImage('https://images.unsplash.com/photo-1750711731797-25c3f2551ff8?w=800&auto=format&fit=crop&q=80', 'produk/kabel-lan.jpg');

        // Download / Copy Gambar Artikel (Foto edukatif & kontekstual artikel)
        $setupImage('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop&q=80', 'artikel/optimalisasi-wifi.jpg');
        if (File::exists(public_path('img/kabel-cat6-fo.jpg'))) {
            File::copy(public_path('img/kabel-cat6-fo.jpg'), storage_path('app/public/artikel/kabel-cat6-fo.jpg'));
        }
        $setupImage('https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=800&auto=format&fit=crop&q=80', 'artikel/maintenance-jaringan.jpg');

        // Download / Copy Gambar Galeri (Foto orang / teknisi / tim kerja)
        $setupImage('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&auto=format&fit=crop&q=80', 'galeri/rack-server.jpg');
        $setupImage('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&auto=format&fit=crop&q=80', 'galeri/access-point-test.jpg');
        $setupImage('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80', 'galeri/terminasi-fiber-optic.jpg');

        // 1. DATA PRODUK / LAYANAN (3 Item Simpel & Sinkron)
        Produk::truncate();
        Produk::create([
            'nama_produk' => 'Router WiFi Dual-Band Gigabit',
            'harga'       => 650000,
            'deskripsi'   => "Router WiFi nirkabel dual-band berkecepatan tinggi dengan 4 antena eksternal untuk koneksi internet kantor dan rumah yang stabil.",
            'gambar'      => 'produk/router-wifi.jpg'
        ]);

        Produk::create([
            'nama_produk' => 'Switch Hub 8-Port Gigabit Ethernet',
            'harga'       => 450000,
            'deskripsi'   => "Switch penghubung 8 port Gigabit untuk distribusi koneksi kabel LAN ke komputer PC, laptop, printer, dan server lokal.",
            'gambar'      => 'produk/switch-hub.jpg'
        ]);

        Produk::create([
            'nama_produk' => 'Paket Kabel LAN & Konektor RJ45 Cat6',
            'harga'       => 350000,
            'deskripsi'   => "Kabel UTP Cat6 berkecepatan 1 Gbps lengkap dengan konektor RJ45 berkualitas, plug & play untuk jaringan LAN kantor yang andal.",
            'gambar'      => 'produk/kabel-lan.jpg'
        ]);

        // 2. DATA ARTIKEL / WAWASAN TEKNOLOGI (3 Item)
        Artikel::truncate();
        Artikel::create([
            'judul'       => 'Tips Optimalisasi Jaringan WiFi Kantor agar Stabil dan Bebas Lemot',
            'penulis'     => 'Tim Teknis Solusi Koneksi',
            'isi_artikel' => "Jaringan WiFi yang lambat di lingkungan kantor seringkali bukan disebabkan oleh kuota internet, melainkan interferensi frekuensi, penempatan Access Point yang tidak merata, serta ketiadaan manajemen bandwidth.\n\nDalam artikel ini, kita membahas pentingnya penerapan dual-band 5GHz, segregasi VLAN untuk tamu (Guest Network), dan pemilihan perangkat Access Point standar WiFi 6 guna menampung puluhan perangkat klien secara simultan tanpa penurunan performa (throttling).",
            'gambar'      => 'artikel/optimalisasi-wifi.jpg'
        ]);

        Artikel::create([
            'judul'       => 'Mengenal Perbedaan Kabel UTP Cat6 dan Fiber Optic untuk Backbone Jaringan',
            'penulis'     => 'Divisi Infrastruktur Jaringan',
            'isi_artikel' => "Ketika merancang infrastruktur jaringan lokal (LAN), pemilihan media transmisi antara kabel UTP Cat6 dan Fiber Optic (FO) sangat krusial.\n\nKabel Cat6 sangat handal untuk distribusi horizontal ke meja kerja dengan kecepatan hingga 10 Gbps pada jarak pendek. Namun, untuk koneksi antar lantai (vertikal) atau antar gedung berjarak lebih dari 100 meter, kabel Fiber Optic menjadi standar wajib karena tahan terhadap interferensi elektromagnetik dan memiliki kapasitas throughput data yang jauh lebih tinggi.",
            'gambar'      => 'artikel/kabel-cat6-fo.jpg'
        ]);

        Artikel::create([
            'judul'       => 'Pentingnya Pemeliharaan Jaringan Rutin (Preventive Maintenance) bagi Perusahaan',
            'penulis'     => 'Administrator Jaringan',
            'isi_artikel' => "Downtime jaringan dapat mengakibatkan kerugian operasional dan hilangnya produktivitas kerja karyawan secara signifikan.\n\nPreventive Maintenance secara berkala meliputi pengecekan temperatur rak server, manajemen kabel patch panel yang rapi, update firmware keamanan router/firewall, serta backup rutin konfigurasi sistem. Langkah pencegahan ini mampu menurunkan risiko kegagalan sistem hingga 90% dan memperpanjang masa pakai perangkat hardware IT.",
            'gambar'      => 'artikel/maintenance-jaringan.jpg'
        ]);

        // 3. DATA GALERI KEGIATAN (3 Item)
        Galeri::truncate();
        Galeri::create([
            'judul'  => 'Instalasi Kabel Data Rack Server & Patch Panel Gedung Korporat',
            'gambar' => 'galeri/rack-server.jpg'
        ]);

        Galeri::create([
            'judul'  => 'Setup Access Point WiFi & Pengujian Throughput Sinyal Gedung Kantor',
            'gambar' => 'galeri/access-point-test.jpg'
        ]);

        Galeri::create([
            'judul'  => 'Pemasangan & Terminasi Kabel Fiber Optic Antar Lantai Perusahaan',
            'gambar' => 'galeri/terminasi-fiber-optic.jpg'
        ]);
    }
}