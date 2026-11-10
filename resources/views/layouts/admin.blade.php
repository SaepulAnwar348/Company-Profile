<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PT Solusi Koneksi Anda - Admin Panel')</title>
    
    {{-- CSS Framework Bootstrap 5, Icons, & Fonts --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

    {{-- Proteksi Sesi Tab: Mengharuskan login ulang jika URL disalin & dibuka di tab baru --}}
    <style id="sessionGuardStyle">
        body { visibility: hidden !important; opacity: 0 !important; }
    </style>
    <script>
        (function() {
            if (sessionStorage.getItem('admin_tab_session') === 'active') {
                var s = document.getElementById('sessionGuardStyle');
                if (s) s.remove();
            } else {
                window.location.replace("{{ route('login') }}?warning=tab_baru");
            }
        })();
        document.addEventListener('DOMContentLoaded', function() {
            if (sessionStorage.getItem('admin_tab_session') === 'active') {
                var s = document.getElementById('sessionGuardStyle');
                if (s) s.remove();
            }
        });
    </script>

    {{-- Styling tema tata letak panel administrasi --}}
    <style>
        :root {
            --sidebar-bg: #131826;
            --brand-blue: #2563eb;
            --surface-bg: #f8fafc;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--surface-bg);
            color: #1e293b;
            overflow-x: hidden;
        }
        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Sidebar Menu */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            z-index: 1000;
        }
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .nav-link-custom {
            color: #94a3b8;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .nav-link-custom:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
        }
        .nav-link-custom.active {
            background-color: var(--brand-blue);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }
        .topbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #e2e8f0;
            height: 64px;
        }
        .card-netcore {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }
        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 0.6rem;
            font-size: 0.875rem;
            padding: 0.65rem 0.85rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
    </style>
</head>
<body>

    {{-- SIDEBAR NAVIGASI ADMIN --}}
    <div class="sidebar d-flex flex-column justify-content-between p-3">
        <div>
            {{-- Logo dan nama aplikasi --}}
            <div class="d-flex align-items-center gap-3 px-2 py-3 mb-4">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="rounded-3 flex-shrink-0" style="width: 42px; height: 42px; object-fit: contain;">
                <div class="overflow-hidden">
                    <h6 class="brand-font fw-bold text-white mb-0 text-truncate" style="font-size: 0.9rem;" title="{{ \App\Models\Profil::first()->nama_perusahaan ?? 'PT Solusi Koneksi Anda' }}">{{ \App\Models\Profil::first()->nama_perusahaan ?? 'PT Solusi Koneksi Anda' }}</h6>
                    <small class="text-secondary" style="font-size: 0.72rem;">Panel Administrasi</small>
                </div>
            </div>

            {{-- Tautan menu navigasi modul admin --}}
            <div class="d-flex flex-column gap-1">
                <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.profil.edit') }}" class="nav-link-custom {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    <span>Profil Perusahaan</span>
                </a>
                <a href="{{ route('produk.index') }}" class="nav-link-custom {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Kelola Produk / Layanan</span>
                </a>
                <a href="{{ route('artikel.index') }}" class="nav-link-custom {{ request()->routeIs('artikel.*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Kelola Artikel</span>
                </a>
                <a href="{{ route('galeri.index') }}" class="nav-link-custom {{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i>
                    <span>Kelola Galeri</span>
                </a>
                <a href="{{ route('admin.kontak.index') }}" class="nav-link-custom {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i>
                    <span>Pesan Masuk</span>
                </a>
            </div>
        </div>

        {{-- Tautan keluar (Logout) & link ke landing page publik --}}
        <div class="pt-3 border-top border-secondary border-opacity-25 px-2">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary rounded-pill w-100 mb-2 py-2 d-inline-flex align-items-center justify-content-center gap-2 fw-semibold small text-decoration-none">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>Lihat Website</span>
            </a>

            <button type="button" class="btn btn-link text-danger text-decoration-none d-flex align-items-center gap-2 p-2 small fw-semibold w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right fs-5"></i>
                <span>Log Out</span>
            </button>
        </div>
    </div>

    {{-- KONTEN UTAMA DAN HEADER TOPBAR --}}
    <div class="main-wrapper">
        {{-- Header bar atas (Top bar) --}}
        <header class="topbar sticky-top px-4 d-flex align-items-center justify-content-between">
            <div class="small text-secondary">
                Dashboard <i class="bi bi-chevron-right mx-1 small"></i> <span class="text-dark fw-semibold">@yield('page_title', 'Ringkasan')</span>
            </div>
            
            {{-- Profil admin dan menu logout --}}
            <div class="dropdown">
                    <button class="btn btn-sm d-flex align-items-center gap-2 border-0 bg-transparent p-1 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="small fw-semibold text-dark d-none d-sm-inline">{{ Auth::user()->nama_lengkap ?? 'Administrator' }}</span>
                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold small" style="width: 32px; height: 32px;">
                            {{ substr(Auth::user()->nama_lengkap ?? 'AD', 0, 2) }}
                        </div>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.75rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2 py-2">
                        <li class="px-3 py-1">
                            <div class="fw-semibold small text-dark">{{ Auth::user()->nama_lengkap ?? 'Administrator' }}</div>
                            <div class="text-secondary" style="font-size: 0.75rem;">{{ Auth::user()->username ?? 'admin' }}</div>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <button type="button" class="dropdown-item text-danger small fw-semibold d-flex align-items-center gap-2 py-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar (Logout)</span>
                            </button>
                        </li>
                    </ul>
                </div>
        </header>

        {{-- Area penampung konten dinamis tiap halaman --}}
        <main class="p-4 p-lg-5">
            {{-- Notifikasi flash message sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 p-3 mb-4 small border-0 bg-success-subtle text-success-emphasis shadow-sm d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Notifikasi flash message peringatan / warning --}}
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show rounded-3 p-3 mb-4 small border-0 bg-warning-subtle text-warning-emphasis shadow-sm d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 text-warning"></i>
                    <div>{{ session('warning') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Notifikasi flash message info --}}
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show rounded-3 p-3 mb-4 small border-0 bg-info-subtle text-info-emphasis shadow-sm d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-info-circle-fill fs-5 text-info"></i>
                    <div>{{ session('info') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Notifikasi flash message gagal/error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 p-3 mb-4 small border-0 bg-danger-subtle text-danger-emphasis shadow-sm d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-exclamation-octagon-fill fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Bagian konten dari view anak yang diekstend --}}
            @yield('content')
        </main>
    </div>

    {{-- MODAL POP-UP KONFIRMASI LOGOUT --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="modal-body p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger mb-3" style="width: 68px; height: 68px;">
                        <i class="bi bi-box-arrow-right fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2" id="logoutModalLabel">Konfirmasi Keluar</h5>
                    <p class="text-secondary small mb-4">
                        Apakah Anda yakin ingin keluar dari sistem? Anda harus masuk kembali dengan kredensial akun untuk mengakses panel admin.
                    </p>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light rounded-pill py-2 flex-fill fw-semibold small border text-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <form action="{{ route('logout') }}" method="POST" class="flex-fill m-0" onsubmit="sessionStorage.removeItem('admin_tab_session');">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-pill py-2 w-100 fw-semibold small shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Ya, Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JavaScript Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>