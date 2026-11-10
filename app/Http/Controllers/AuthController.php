<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan antarmuka formulir login untuk administrator.
     * Mengarahkan ke file view resources/views/auth/login.blade.php.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses data autentikasi yang dikirimkan dari form login.
     * Melakukan validasi input, pencocokan kredensial ke database tabel admins,
     * dan pembentukan sesi login baru (session regeneration).
     */
    public function login(Request $request)
    {
        // 1. Validasi input: memastikan field username dan password tidak boleh kosong
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Kolom username wajib diisi.',
            'password.required' => 'Kolom kata sandi wajib diisi.',
        ]);

        // 2. Memeriksa kecocokan data login ke tabel 'admins' menggunakan Auth guard bawaan Laravel
        if (Auth::guard('web')->attempt($credentials)) {
            // Jika berhasil, perbarui session ID untuk mencegah serangan session fixation
            $request->session()->regenerate();

            // Alihkan administrator langsung ke dashboard utama
            return redirect()->route('admin.dashboard');
        }

        // 3. Jika username atau password tidak cocok, kembalikan ke halaman login dengan pesan error
        return back()->withInput($request->only('username'))->withErrors([
            'username' => 'Username atau kata sandi yang dimasukkan salah! Akses ditolak.',
        ]);
    }

    /**
     * Mengeluarkan akun administrator dari sesi aktif (Logout).
     * Menghapus seluruh data sesi dan token CSRF untuk keamanan.
     */
    public function logout(Request $request)
    {
        // Menghapus data login user dari guard 'web'
        Auth::guard('web')->logout();

        // Menghapus dan membatalkan sesi saat ini
        $request->session()->invalidate();

        // Membuat token CSRF baru untuk sesi berikutnya
        $request->session()->regenerateToken();

        // Mengarahkan kembali ke halaman login dengan notifikasi info
        return redirect()->route('login')->with('info', 'Anda telah berhasil keluar (logout) dari sesi admin.');
    }
}