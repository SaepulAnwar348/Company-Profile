<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver Sesi Default (Default Session Driver)
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan driver sesi default yang digunakan untuk setiap
    | permintaan (request) yang masuk. Laravel mendukung berbagai opsi penyimpanan
    | untuk mempertahankan data sesi. Penyimpanan database adalah pilihan default yang sangat baik.
    |
    | Opsi yang didukung: "file", "cookie", "database", "memcached",
    |                     "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Masa Aktif Sesi (Session Lifetime)
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan jumlah menit sesi diizinkan tetap diam (idle)
    | sebelum kedaluwarsa. Jika Anda ingin sesi langsung kedaluwarsa saat browser
    | ditutup, Anda dapat mengaturnya melalui opsi konfigurasi expire_on_close.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Enkripsi Sesi (Session Encryption)
    |--------------------------------------------------------------------------
    |
    | Opsi ini memungkinkan Anda menentukan dengan mudah bahwa seluruh data sesi
    | harus dienkripsi sebelum disimpan. Semua enkripsi dilakukan secara otomatis
    | oleh Laravel dan Anda dapat menggunakan sesi seperti biasa.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Lokasi File Sesi (Session File Location)
    |--------------------------------------------------------------------------
    |
    | Ketika menggunakan driver sesi "file", file-file sesi ditempatkan di disk.
    | Lokasi penyimpanan default didefinisikan di sini; namun, Anda bebas
    | menentukan lokasi lain tempat file sesi tersebut harus disimpan.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Koneksi Database Sesi (Session Database Connection)
    |--------------------------------------------------------------------------
    |
    | Ketika menggunakan driver sesi "database" atau "redis", Anda dapat menentukan
    | koneksi yang harus digunakan untuk mengelola sesi ini. Ini harus sesuai dengan
    | koneksi dalam opsi konfigurasi database Anda.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Table
    | Tabel Database Sesi (Session Database Table)
    |--------------------------------------------------------------------------
    |
    | Ketika menggunakan driver sesi "database", Anda dapat menentukan tabel
    | yang digunakan untuk menyimpan sesi. Tentu saja, nilai default yang wajar
    | telah ditentukan untuk Anda; namun, Anda dipersilakan mengubahnya ke tabel lain.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Cache Store Sesi (Session Cache Store)
    |--------------------------------------------------------------------------
    |
    | Ketika menggunakan salah satu backend sesi berbasis cache di framework ini,
    | Anda dapat mendefinisikan cache store yang harus digunakan untuk menyimpan data
    | sesi antar request. Ini harus cocok dengan salah satu cache store yang Anda tentukan.
    |
    | Affects: "dynamodb", "memcached", "redis"
    | Berpengaruh pada: "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Peluang Pembersihan Sesi (Session Sweeping Lottery)
    |--------------------------------------------------------------------------
    |
    | Beberapa driver sesi harus membersihkan lokasi penyimpanannya secara manual
    | untuk menghapus sesi lama dari penyimpanan. Berikut peluang hal itu terjadi
    | pada suatu request. Secara default, peluangnya adalah 2 dari 100 (2%).
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nama Cookie Sesi (Session Cookie Name)
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat mengubah nama cookie sesi yang dibuat oleh framework.
    | Biasanya, Anda tidak perlu mengubah nilai ini karena melakukannya tidak
    | memberikan peningkatan keamanan yang berarti.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Path Cookie Sesi (Session Cookie Path)
    |--------------------------------------------------------------------------
    |
    | Path cookie sesi menentukan path di mana cookie dianggap tersedia.
    | Biasanya, ini adalah path root dari aplikasi Anda, namun Anda bebas
    | mengubahnya jika diperlukan.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Domain Cookie Sesi (Session Cookie Domain)
    |--------------------------------------------------------------------------
    |
    | Nilai ini menentukan domain dan subdomain tempat cookie sesi tersedia.
    | Secara default, cookie akan tersedia untuk root domain tanpa subdomain.
    | Biasanya, nilai ini tidak perlu diubah.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    | Cookie Hanya HTTPS (HTTPS Only Cookies)
    |--------------------------------------------------------------------------
    |
    | Dengan menyetel opsi ini ke true, cookie sesi hanya akan dikirim kembali
    | ke server jika browser memiliki koneksi HTTPS. Ini akan mencegah cookie
    | terkirim saat koneksi tidak aman.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Akses Hanya Lewat HTTP (HTTP Access Only)
    |--------------------------------------------------------------------------
    |
    | Menyetel opsi ini ke true akan mencegah JavaScript mengakses nilai cookie
    | sehingga cookie hanya dapat diakses melalui protokol HTTP. Sangat tidak
    | disarankan untuk menonaktifkan opsi ini demi alasan keamanan.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Cookie Same-Site (Same-Site Cookies)
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan bagaimana cookie Anda berperilaku saat permintaan lintas
    | situs (cross-site) terjadi, dan dapat digunakan untuk mencegah serangan CSRF.
    | Secara default, nilai ini diatur ke "lax" untuk mengizinkan request lintas situs yang aman.
    |
    | Lihat: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Opsi yang didukung: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Berpartisi (Partitioned Cookies)
    |--------------------------------------------------------------------------
    |
    | Menyetel opsi ini ke true akan mengikat cookie ke situs tingkat atas untuk
    | konteks lintas situs. Cookie berpartisi diterima oleh browser jika ditandai
    | "secure" dan atribut Same-Site disetel ke "none".
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
