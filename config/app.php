<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    | Nama Aplikasi (Application Name)
    |--------------------------------------------------------------------------
    |
    | Nilai ini merupakan nama aplikasi Anda, yang akan digunakan ketika
    | framework perlu menempatkan nama aplikasi pada notifikasi atau
    | elemen antarmuka pengguna (UI) lain yang memerlukan tampilan nama aplikasi.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Lingkungan Aplikasi (Application Environment)
    |--------------------------------------------------------------------------
    |
    | Nilai ini menentukan "lingkungan" (environment) tempat aplikasi Anda
    | saat ini sedang berjalan. Nilai ini dapat menentukan preferensi konfigurasi
    | berbagai layanan yang digunakan aplikasi. Atur nilai ini di file ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Mode Debug Aplikasi (Application Debug Mode)
    |--------------------------------------------------------------------------
    |
    | Ketika aplikasi Anda berada dalam mode debug, pesan kesalahan terperinci
    | beserta stack trace akan ditampilkan pada setiap error yang terjadi dalam
    | aplikasi. Jika dinonaktifkan, halaman kesalahan umum sederhana akan ditampilkan.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL Aplikasi (Application URL)
    |--------------------------------------------------------------------------
    |
    | URL ini digunakan oleh console untuk menghasilkan URL dengan benar ketika
    | menggunakan tool baris perintah Artisan. Anda harus mengatur ini ke root
    | dari aplikasi agar tersedia dalam perintah-perintah Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Zona Waktu Aplikasi (Application Timezone)
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan zona waktu default untuk aplikasi Anda,
    | yang akan digunakan oleh fungsi-fungsi tanggal dan waktu PHP. Zona waktu
    | diatur ke "UTC" secara default karena cocok untuk sebagian besar kasus penggunaan.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'Asia/Jakarta'),

    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Bahasa Aplikasi (Application Locale Configuration)
    |--------------------------------------------------------------------------
    |
    | Pengaturan bahasa aplikasi menentukan bahasa default yang akan digunakan
    | oleh metode terjemahan / lokalisasi Laravel. Opsi ini dapat diatur ke
    | bahasa apa pun yang string terjemahannya sudah Anda siapkan.
    |
    */

    'locale' => env('APP_LOCALE', 'id'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Kunci Enkripsi (Encryption Key)
    |--------------------------------------------------------------------------
    |
    | Kunci ini digunakan oleh layanan enkripsi Laravel dan harus diatur
    | ke string acak sepanjang 32 karakter untuk memastikan semua nilai
    | terenkripsi aman. Lakukan hal ini sebelum melakukan deployment aplikasi.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver Mode Pemeliharaan (Maintenance Mode Driver)
    |--------------------------------------------------------------------------
    |
    | Opsi konfigurasi ini menentukan driver yang digunakan untuk menentukan dan
    | mengelola status "mode pemeliharaan" (maintenance mode) Laravel. Driver "cache"
    | memungkinkan mode pemeliharaan dikontrol di beberapa server/mesin sekaligus.
    |
    | Driver yang didukung: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
