<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PT Solusi Koneksi Anda</title>
    {{-- Framework CSS Bootstrap 5 & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Styling khusus halaman login split-screen --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }
        .heading-font {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Panel Kiri Gelap */
        .left-panel {
            background-color: #111827;
            color: #ffffff;
            min-height: 100vh;
            position: relative;
            background-image: 
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(30, 64, 175, 0.12) 0px, transparent 50%);
        }
        .pill-badge {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            font-size: 0.72rem;
            letter-spacing: 0.08em;
        }
        .building-card {
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 1.25rem;
            overflow: hidden;
            position: relative;
            box-shadow: 0 25px 35px -5px rgba(0, 0, 0, 0.6);
        }
        .building-card img {
            width: 100%;
            height: 340px;
            object-fit: cover;
            display: block;
        }
        /* Panel Kanan Form Login */
        .login-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 440px;
        }
        .form-control {
            border-color: #e2e8f0;
            padding: 0.7rem 0.85rem;
            font-size: 0.9rem;
            border-radius: 0.6rem;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12);
        }
        .input-group-text {
            background-color: #ffffff;
            border-color: #e2e8f0;
            color: #94a3b8;
            border-radius: 0.6rem 0 0 0.6rem;
        }
        .btn-login {
            background-color: #0b57d0;
            border: none;
            padding: 0.8rem;
            font-weight: 600;
            font-size: 0.92rem;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
        }
        .btn-login:hover {
            background-color: #0842a0;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            
            {{-- PANEL KIRI: Branding & Foto Profil Perusahaan --}}
            <div class="col-lg-6 left-panel d-none d-lg-flex flex-column justify-content-between p-5">
                
                {{-- Logo dan nama perusahaan --}}
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="rounded-3 flex-shrink-0" style="width: 42px; height: 42px; object-fit: contain;">
                    <span class="fw-bold fs-5 tracking-tight text-white">PT Solusi Koneksi Anda</span>
                </div>

                {{-- Judul dan deskripsi ringkas --}}
                <div class="my-auto py-3" style="max-width: 560px;">
                    <h1 class="heading-font fw-bold text-white mb-2" style="font-size: 2.3rem; line-height: 1.2;">
                        Pusat Kendali Ekosistem Perangkat & Layanan Jaringan
                    </h1>
                    <p class="text-secondary mb-4 small" style="line-height: 1.6;">
                        Kelola katalog produk perangkat, layanan instalasi jaringan & WiFi, artikel teknologi, serta galeri proyek dengan antarmuka yang aman, cepat, dan intuitif.
                    </p>

                    {{-- Foto gedung kantor operasional --}}
                    <div class="building-card">
                        <img src="{{ asset('img/gedung.png') }}" alt="Pusat Operasional">
                    </div>
                </div>

                {{-- Hak cipta --}}
                <div class="pt-2 text-white-50 small" style="font-size: 0.78rem;">
                    © 2026 PT Solusi Koneksi Anda. Seluruh hak cipta dilindungi.
                </div>
            </div>

            {{-- PANEL KANAN: Formulir Login Administrator --}}
            <div class="col-lg-6 d-flex flex-column justify-content-between align-items-center p-4 p-md-5 position-relative">
                
                <div class="login-card p-4 p-md-5 my-auto">
                    {{-- Header sambutan form login --}}
                    <div class="text-center mb-4">
                        <h2 class="heading-font fw-bold text-dark fs-4 mb-1">Selamat Datang Kembali</h2>
                        <p class="text-muted small">Masuk untuk mengelola sistem konten.</p>
                    </div>

                    {{-- Peringatan Keamanan / Sesi Akses Terbatas (Session Warning) --}}
                    @if (session('warning') || request('warning'))
                        <div class="alert alert-warning py-3 px-3 small rounded-3 mb-3 border-0 d-flex align-items-start gap-2 shadow-sm" style="background-color: #fffbeb; color: #92400e; border: 1px solid #fde68a !important; border-left: 4px solid #f59e0b !important;">
                            <i class="bi bi-shield-lock-fill fs-5 text-warning flex-shrink-0 mt-1"></i>
                            <div>
                                <div class="fw-bold mb-1" style="font-size: 0.85rem;">Peringatan Akses Sesi:</div>
                                <div style="line-height: 1.5;">
                                    @if(request('warning') == 'tab_baru')
                                        Sesi tidak aktif di tab baru ini. Silakan login kembali dengan akun administrator Anda untuk mengakses panel admin.
                                    @else
                                        {{ session('warning') ?? 'Silakan login terlebih dahulu untuk mengakses panel admin.' }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Pesan Informasi / Sesi Keluar (Session Info) --}}
                    @if (session('info'))
                        <div class="alert alert-info py-2 px-3 small rounded-3 mb-3 border-0 d-flex align-items-center gap-2 shadow-sm" style="background-color: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd !important; border-left: 4px solid #0ea5e9 !important;">
                            <i class="bi bi-info-circle-fill fs-5 text-info flex-shrink-0"></i>
                            <div>{{ session('info') }}</div>
                        </div>
                    @endif

                    {{-- Pesan Sukses (Session Success) --}}
                    @if (session('success'))
                        <div class="alert alert-success py-2 px-3 small rounded-3 mb-3 border-0 d-flex align-items-center gap-2 shadow-sm" style="background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0 !important; border-left: 4px solid #22c55e !important;">
                            <i class="bi bi-check-circle-fill fs-5 text-success flex-shrink-0"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    {{-- Pesan error login jika kredensial salah --}}
                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3 border-0 d-flex align-items-center gap-2 shadow-sm" style="background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca !important; border-left: 4px solid #ef4444 !important;">
                            <i class="bi bi-exclamation-triangle-fill fs-5 text-danger flex-shrink-0"></i>
                            <div>{{ $errors->first() }}</div>
                        </div>
                    @endif

                    {{-- Form submit login (method POST ke login.post) --}}
                    <form action="{{ route('login.post') }}" method="POST" onsubmit="sessionStorage.setItem('admin_tab_session', 'active');">
                        @csrf
                        
                        {{-- Input username --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Email atau Username</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="bi bi-person"></i></span>
                                <input type="text" name="username" class="form-control border-start-0 ps-0 @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="admin" required autofocus>
                            </div>
                            @error('username') <div class="text-danger small mt-1" style="font-size: 0.78rem;">{{ $message }}</div> @enderror
                        </div>

                        {{-- Input kata sandi dengan tombol toggle tampil/sembunyi --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label small fw-semibold text-secondary mb-0">Kata Sandi</label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" id="passwordField" class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                <button type="button" class="input-group-text border-start-0 bg-transparent" onclick="togglePassword()">
                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password') <div class="text-danger small mt-1" style="font-size: 0.78rem;">{{ $message }}</div> @enderror
                        </div>

                        {{-- Checkbox ingat sesi --}}
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label small text-muted" for="rememberMe">
                                Ingat sesi saya
                            </label>
                        </div>

                        {{-- Tombol submit login --}}
                        <button type="submit" class="btn btn-primary btn-login w-100 text-white d-flex align-items-center justify-content-center gap-2">
                            <span>Masuk ke Admin Dashboard</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>

                    {{-- Catatan keamanan sistem --}}
                    <div class="text-center mt-4 pt-3 border-top text-muted small" style="font-size: 0.78rem;">
                        <i class="bi bi-shield-lock me-1"></i> Sistem Dilindungi. Akses terbatas untuk admin.
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Script JavaScript toggle visibility password (tampil/sembunyi) --}}
    <script>
        function togglePassword() {
            const field = document.getElementById('passwordField');
            const icon = document.getElementById('toggleIcon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                field.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }
    </script>
</body>
</html>