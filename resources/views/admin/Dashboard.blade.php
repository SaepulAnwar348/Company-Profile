@extends('layouts.admin')

@section('title', 'Dashboard - PT Solusi Koneksi Anda')
@section('page_title', 'Ringkasan')

@section('content')
<style>
    /* ════════════════════════════════
       DASHBOARD PREMIUM STYLES (BLUE)
       ════════════════════════════════ */

    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #0284c7 100%);
        border-radius: 1.25rem;
        padding: 2rem 2.25rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(37,99,235,0.18);
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -15%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 10%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 60%);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-banner h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 0.35rem;
        position: relative;
        z-index: 1;
    }

    .welcome-banner p {
        font-size: 0.88rem;
        opacity: 0.85;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
        max-width: 520px;
    }


    /* Stat Cards */
    .stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.1rem;
        padding: 1.5rem;
        transition: all 0.3s cubic-bezier(.16,1,.3,1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8, #0284c7);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px -8px rgba(37,99,235,0.1);
        border-color: #cbd5e1;
    }

    .stat-card:hover::after {
        transform: scaleX(1);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.08) rotate(-3deg);
    }

    .stat-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.35rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .stat-value {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: #0f1729;
        line-height: 1;
    }

    .stat-card-accent {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border: none;
        color: #fff;
        box-shadow: 0 6px 24px rgba(37,99,235,0.22);
    }

    .stat-card-accent .stat-label {
        color: rgba(255,255,255,0.7);
    }

    .stat-card-accent .stat-value {
        color: #fff;
    }

    .stat-card-accent .stat-icon {
        background: rgba(255,255,255,0.18) !important;
        color: #fff !important;
    }

    .stat-card-accent:hover {
        box-shadow: 0 16px 40px rgba(37,99,235,0.3);
    }

    .stat-card-accent::after {
        display: none;
    }

    .stat-badge {
        background: rgba(255,255,255,0.2);
        color: #fff;
        border-radius: 999px;
        padding: 0.15rem 0.55rem;
        font-size: 0.68rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Content Cards */
    .dash-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.1rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .dash-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    }

    .dash-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dash-card-header h5 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        color: #0f1729;
        margin-bottom: 0;
    }

    .dash-card-header p {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-bottom: 0;
    }

    .dash-card-footer {
        padding: 0.85rem 1.5rem;
        background: #fafbfe;
        border-top: 1px solid #f1f5f9;
        text-align: center;
    }

    .dash-card-footer a,
    .dash-card-footer button.btn-dash-link {
        font-size: 0.82rem;
        font-weight: 600;
        color: #2563eb;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: gap 0.2s, color 0.2s;
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        outline: none;
    }

    .dash-card-footer a:hover,
    .dash-card-footer button.btn-dash-link:hover {
        gap: 0.5rem;
        color: #1d4ed8;
    }

    /* Table */
    .dash-table tbody tr {
        transition: background 0.2s ease;
    }

    .dash-table tbody tr:hover {
        background: #f8fafc;
    }

    .dash-table thead th {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94a3b8;
        border-bottom: 1px solid #f1f5f9;
        padding: 0.85rem 1rem;
    }

    .dash-table tbody td {
        padding: 0.85rem 1rem;
        font-size: 0.84rem;
        vertical-align: middle;
        border-bottom: 1px solid #f5f7fa;
    }

    .product-thumb {
        width: 40px;
        height: 40px;
        border-radius: 0.65rem;
        object-fit: cover;
        border: 1px solid #e2e8f0;
    }

    .product-thumb-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .price-chip {
        background: #eff6ff;
        color: #2563eb;
        border-radius: 999px;
        padding: 0.2rem 0.65rem;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-block;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.35rem;
    }

    /* Quick Action Buttons */
    .qa-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.1rem;
        padding: 1.5rem;
    }

    .qa-card h6 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.92rem;
        color: #0f1729;
        margin-bottom: 1rem;
    }

    .qa-btn {
        border-radius: 0.75rem;
        padding: 0.7rem 1rem;
        font-size: 0.82rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.25s ease;
        text-decoration: none;
        border: 1.5px solid #e2e8f0;
        color: #334155;
        background: #fff;
    }

    .qa-btn:hover {
        border-color: #2563eb;
        color: #2563eb;
        background: #eff6ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37,99,235,0.08);
    }

    .qa-btn.qa-primary {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
        box-shadow: 0 3px 12px rgba(37,99,235,0.2);
    }

    .qa-btn.qa-primary:hover {
        background: #1d4ed8;
        color: #fff;
        box-shadow: 0 6px 20px rgba(37,99,235,0.3);
    }

    /* Activity items */
    .activity-item {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.85rem 0;
        border-bottom: 1px solid #f5f7fa;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .article-thumb {
        width: 48px;
        height: 48px;
        border-radius: 0.65rem;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }

    .article-thumb:hover {
        transform: scale(1.05);
    }

    .article-thumb-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        background: #f0fdfa;
        color: #0d9488;
        border: 1px solid #ccfbf1;
    }

    .activity-dot {
        width: 48px;
        height: 48px;
        border-radius: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .activity-text {
        font-size: 0.82rem;
        color: #334155;
        line-height: 1.5;
    }

    .activity-time {
        font-size: 0.7rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Gallery thumbs */
    .gal-thumb {
        width: 100%;
        height: 70px;
        border-radius: 0.65rem;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        transition: transform 0.3s ease;
    }

    .gal-thumb:hover {
        transform: scale(1.03);
    }

    .gal-placeholder {
        width: 100%;
        height: 70px;
        border-radius: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
</style>

<div class="container-fluid p-0">

    {{-- Banner sambutan selamat datang untuk admin yang login --}}
    <div class="welcome-banner mb-4">
        <div>
            <h3>Selamat Datang, {{ Auth::user()->nama_lengkap ?? 'Administrator' }} 👋</h3>
            <p>Pantau ringkasan data perusahaan, kelola produk & layanan, dan lihat pesan masuk dari pelanggan secara realtime.</p>
        </div>
    </div>

    {{-- Baris 4 kartu statistik data (Produk, Artikel, Galeri, Pesan Masuk) --}}
    <div class="row g-3 mb-4">
        {{-- Total Produk & Layanan --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: #eff6ff; color: #2563eb;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
                <div class="stat-label">Total Produk & Layanan</div>
                <div class="stat-value">{{ \App\Models\Produk::count() }}</div>
            </div>
        </div>

        {{-- Total Artikel Diterbitkan --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: #f0fdfa; color: #0d9488;">
                        <i class="bi bi-newspaper"></i>
                    </div>
                </div>
                <div class="stat-label">Artikel Diterbitkan</div>
                <div class="stat-value">{{ \App\Models\Artikel::count() }}</div>
            </div>
        </div>

        {{-- Total Foto Dokumentasi Galeri --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: #ecfeff; color: #0891b2;">
                        <i class="bi bi-images"></i>
                    </div>
                </div>
                <div class="stat-label">Foto Dokumentasi</div>
                <div class="stat-value">{{ \App\Models\Galeri::count() }}</div>
            </div>
        </div>

        {{-- Total Pesan Masuk Pengunjung --}}
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-accent h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.18); color: #fff;">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <span class="stat-badge">
                        <i class="bi bi-circle-fill" style="font-size: 5px;"></i>
                        Live
                    </span>
                </div>
                <div class="stat-label">Pesan Masuk</div>
                <div class="stat-value">{{ \App\Models\KontakKami::count() }}</div>
            </div>
        </div>
    </div>

    {{-- Baris 2: Tabel 5 produk terbaru & tombol menu aksi cepat --}}
    <div class="row g-4 mb-4">
        {{-- Tabel produk terbaru --}}
        <div class="col-lg-8">
            <div class="dash-card h-100 d-flex flex-column">
                <div class="dash-card-header">
                    <div>
                        <h5>Produk & Layanan Terbaru</h5>
                        <p>Daftar item produk dan layanan terkini dalam katalog.</p>
                    </div>
                    <span class="badge rounded-pill" style="background: #eff6ff; color: #2563eb; font-size: 0.72rem; font-weight: 600; padding: 0.35rem 0.75rem;">
                        {{ \App\Models\Produk::count() }} Item
                    </span>
                </div>

                <div class="flex-grow-1">
                    <div class="table-responsive">
                        <table class="table dash-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Item / Layanan</th>
                                    <th>Harga / Tarif</th>
                                    <th>Deskripsi Singkat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Produk::latest()->take(3)->get() as $item)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($item->gambar && (file_exists(public_path('storage/' . $item->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($item->gambar)))
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="product-thumb shadow-sm">
                                            @else
                                                <div class="product-thumb-placeholder" style="background: #eff6ff; color: #2563eb;">
                                                    <i class="bi bi-hdd-network"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold" style="color: #0f1729;">{{ $item->nama_produk }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price-chip">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                    </td>
                                    <td style="max-width: 250px; color: #64748b;" class="text-truncate">
                                        {{ $item->deskripsi }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5" style="color: #94a3b8;">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Belum ada item produk & layanan di database.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="dash-card-footer">
                    <button type="button" class="btn-dash-link" data-bs-toggle="modal" data-bs-target="#modalSemuaProduk">
                        <span>Lihat Semua Produk & Layanan</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi Cepat (Pintasan Tambah Data) --}}
        <div class="col-lg-4">
            <div class="qa-card h-100">
                <h6><i class="bi bi-lightning-charge-fill me-1" style="color: #2563eb;"></i> Aksi Cepat</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('produk.create') }}" class="qa-btn">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Produk / Layanan</span>
                    </a>
                    <a href="{{ route('artikel.create') }}" class="qa-btn qa-primary">
                        <i class="bi bi-pencil-square"></i>
                        <span>Tulis Artikel Baru</span>
                    </a>
                    <a href="{{ route('galeri.create') }}" class="qa-btn">
                        <i class="bi bi-cloud-upload"></i>
                        <span>Upload Galeri</span>
                    </a>
                    <a href="{{ route('admin.kontak.index') }}" class="qa-btn">
                        <i class="bi bi-envelope-open"></i>
                        <span>Lihat Pesan Masuk</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris 3: Artikel Terbaru (kiri) & Galeri Dokumentasi (kanan) --}}
    <div class="row g-4">
        {{-- Daftar artikel terbaru --}}
        <div class="col-lg-6">
            <div class="dash-card h-100 d-flex flex-column">
                <div class="dash-card-header">
                    <div>
                        <h5><i class="bi bi-newspaper me-2" style="color: #0d9488;"></i>Artikel Terbaru</h5>
                        <p>Postingan artikel terakhir yang dipublikasikan.</p>
                    </div>
                    <span class="badge rounded-pill" style="background: #f0fdfa; color: #0d9488; font-size: 0.72rem; font-weight: 600; padding: 0.35rem 0.75rem;">
                        {{ \App\Models\Artikel::count() }} Artikel
                    </span>
                </div>
                <div class="px-4 py-2 flex-grow-1">
                    @forelse(\App\Models\Artikel::latest()->take(3)->get() as $art)
                    <div class="activity-item">
                        {{-- Gambar thumbnail sampul artikel --}}
                        @if($art->gambar && (file_exists(public_path('storage/' . $art->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($art->gambar)))
                            <img src="{{ asset('storage/' . $art->gambar) }}" alt="{{ $art->judul }}" class="article-thumb shadow-sm">
                        @else
                            <div class="article-thumb-placeholder">
                                <i class="bi bi-newspaper"></i>
                            </div>
                        @endif
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="activity-text fw-semibold text-dark text-truncate d-block" title="{{ $art->judul }}">{{ $art->judul }}</div>
                            <div class="activity-time d-flex align-items-center gap-2 mt-1">
                                <span><i class="bi bi-person me-1"></i>{{ $art->penulis }}</span>
                                @if($art->created_at)
                                <span>•</span>
                                <span><i class="bi bi-calendar3 me-1"></i>{{ $art->created_at->translatedFormat('d M Y') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4" style="color: #94a3b8; font-size: 0.82rem;">
                        <i class="bi bi-journal d-block fs-4 mb-1"></i>
                        Belum ada artikel.
                    </div>
                    @endforelse
                </div>
                <div class="dash-card-footer">
                    <button type="button" class="btn-dash-link" data-bs-toggle="modal" data-bs-target="#modalSemuaArtikel">
                        <span>Lihat Semua Artikel</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Daftar galeri dokumentasi terbaru --}}
        <div class="col-lg-6">
            <div class="dash-card h-100 d-flex flex-column">
                <div class="dash-card-header">
                    <div>
                        <h5><i class="bi bi-images me-2" style="color: #0891b2;"></i>Galeri Terbaru</h5>
                        <p>Dokumentasi foto proyek terkini.</p>
                    </div>
                    <span class="badge rounded-pill" style="background: #ecfeff; color: #0891b2; font-size: 0.72rem; font-weight: 600; padding: 0.35rem 0.75rem;">
                        {{ \App\Models\Galeri::count() }} Foto
                    </span>
                </div>
                <div class="px-4 py-3 flex-grow-1">
                    @php $galeriItems = \App\Models\Galeri::latest()->take(3)->get(); @endphp
                    @if($galeriItems->count() > 0)
                    <div class="row g-2">
                        @foreach($galeriItems as $gal)
                        <div class="col-4">
                            @if($gal->gambar && (file_exists(public_path('storage/' . $gal->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($gal->gambar)))
                                <img src="{{ asset('storage/' . $gal->gambar) }}" alt="{{ $gal->judul }}" class="gal-thumb shadow-sm" title="{{ $gal->judul }}">
                            @else
                                <div class="gal-placeholder" style="background: #ecfeff; color: #0891b2;">
                                    <i class="bi bi-camera"></i>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        @foreach($galeriItems as $gal)
                        <div class="d-flex align-items-center gap-2 py-1">
                            <i class="bi bi-dot" style="color: #0891b2; font-size: 1.2rem;"></i>
                            <span class="small text-truncate" style="max-width: 280px; color: #334155; font-weight: 500;">{{ $gal->judul }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4" style="color: #94a3b8; font-size: 0.82rem;">
                        <i class="bi bi-camera d-block fs-4 mb-1"></i>
                        Belum ada foto galeri.
                    </div>
                    @endif
                </div>
                <div class="dash-card-footer">
                    <button type="button" class="btn-dash-link" data-bs-toggle="modal" data-bs-target="#modalSemuaGaleri">
                        <span>Lihat Semua Galeri</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════════════════ --}}
{{-- MODAL LIHAT SEMUA DATA (TETAP DI DASHBOARD TANPA PINDAH HALAMAN)     --}}
{{-- ════════════════════════════════════════════════════════════════════ --}}

{{-- 1. MODAL SEMUA PRODUK & LAYANAN --}}
<div class="modal fade" id="modalSemuaProduk" tabindex="-1" aria-labelledby="modalSemuaProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
            <div class="modal-header border-bottom px-4 py-3" style="background: #f8fafc;">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3" style="width: 38px; height: 38px; background: #eff6ff; color: #2563eb;">
                        <i class="bi bi-box-seam fs-5"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0" id="modalSemuaProdukLabel">Semua Produk & Layanan</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Total {{ \App\Models\Produk::count() }} item terdaftar dalam katalog</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f1f5f9;">
                            <tr>
                                <th class="ps-4 text-secondary text-uppercase small fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em; width: 60px;">No</th>
                                <th class="text-secondary text-uppercase small fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;">Produk / Layanan</th>
                                <th class="text-secondary text-uppercase small fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em; width: 200px;">Harga</th>
                                <th class="pe-4 text-secondary text-uppercase small fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Produk::orderBy('id_produk', 'asc')->get() as $index => $item)
                            <tr>
                                <td class="ps-4 fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item->gambar && (file_exists(public_path('storage/' . $item->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($item->gambar)))
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="rounded-3 shadow-sm flex-shrink-0" style="width: 46px; height: 46px; object-fit: cover;">
                                        @else
                                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #eff6ff; color: #2563eb;">
                                                <i class="bi bi-hdd-network fs-5"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $item->nama_produk }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="price-chip">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="pe-4" style="font-size: 0.82rem; color: #64748b;">
                                    {{ $item->deskripsi }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-secondary">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada produk atau layanan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2 bg-light d-flex justify-content-end">
                <button type="button" class="btn btn-secondary rounded-pill px-4 py-1 small fw-semibold" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- 2. MODAL SEMUA ARTIKEL --}}
<div class="modal fade" id="modalSemuaArtikel" tabindex="-1" aria-labelledby="modalSemuaArtikelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
            <div class="modal-header border-bottom px-4 py-3" style="background: #f8fafc;">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3" style="width: 38px; height: 38px; background: #f0fdfa; color: #0d9488;">
                        <i class="bi bi-newspaper fs-5"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0" id="modalSemuaArtikelLabel">Semua Artikel</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Total {{ \App\Models\Artikel::count() }} artikel terpublikasi</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex flex-column gap-3">
                    @forelse(\App\Models\Artikel::orderBy('id_artikel', 'asc')->get() as $index => $art)
                    <div class="p-3 rounded-3 border bg-white shadow-sm d-flex gap-3 align-items-start position-relative">
                        <span class="badge bg-light text-secondary border fw-bold position-absolute top-0 start-0 translate-middle rounded-pill px-2" style="font-size: 0.7rem; z-index: 2;">
                            {{ $index + 1 }}
                        </span>
                        @if($art->gambar && (file_exists(public_path('storage/' . $art->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($art->gambar)))
                            <img src="{{ asset('storage/' . $art->gambar) }}" alt="{{ $art->judul }}" class="rounded-3 shadow-sm flex-shrink-0" style="width: 72px; height: 72px; object-fit: cover;">
                        @else
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 72px; height: 72px; background: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1;">
                                <i class="bi bi-newspaper fs-3"></i>
                            </div>
                        @endif
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="fw-bold text-dark mb-1" style="font-size: 0.92rem;">{{ $art->judul }}</h6>
                            <div class="d-flex align-items-center gap-2 text-secondary mb-2" style="font-size: 0.75rem;">
                                <span><i class="bi bi-person me-1"></i>{{ $art->penulis }}</span>
                                @if($art->created_at)
                                <span>•</span>
                                <span><i class="bi bi-calendar3 me-1"></i>{{ $art->created_at->translatedFormat('d M Y') }}</span>
                                @endif
                            </div>
                            <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                {{ Str::limit(strip_tags($art->isi), 180) }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 text-secondary">
                        <i class="bi bi-journal fs-1 d-block mb-2"></i>
                        Belum ada artikel yang dipublikasikan.
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2 bg-light d-flex justify-content-end">
                <button type="button" class="btn btn-secondary rounded-pill px-4 py-1 small fw-semibold" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- 3. MODAL SEMUA GALERI DOKUMENTASI --}}
<div class="modal fade" id="modalSemuaGaleri" tabindex="-1" aria-labelledby="modalSemuaGaleriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
            <div class="modal-header border-bottom px-4 py-3" style="background: #f8fafc;">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3" style="width: 38px; height: 38px; background: #ecfeff; color: #0891b2;">
                        <i class="bi bi-images fs-5"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0" id="modalSemuaGaleriLabel">Semua Galeri Dokumentasi</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Total {{ \App\Models\Galeri::count() }} foto dokumentasi kegiatan & proyek</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    @forelse(\App\Models\Galeri::orderBy('id_galeri', 'asc')->get() as $index => $gal)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 border shadow-sm rounded-3 overflow-hidden position-relative">
                            <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-0 m-2 rounded-pill px-2" style="font-size: 0.7rem; z-index: 2;">
                                #{{ $index + 1 }}
                            </span>
                            @if($gal->gambar && (file_exists(public_path('storage/' . $gal->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($gal->gambar)))
                                <img src="{{ asset('storage/' . $gal->gambar) }}" alt="{{ $gal->judul }}" class="card-img-top" style="height: 160px; object-fit: cover;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 160px; background: #ecfeff; color: #0891b2;">
                                    <i class="bi bi-camera fs-1"></i>
                                </div>
                            @endif
                            <div class="card-body p-3 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="card-title fw-bold text-dark small mb-1 text-truncate" title="{{ $gal->judul }}">{{ $gal->judul }}</h6>
                                    @if($gal->keterangan)
                                        <p class="card-text text-secondary small text-truncate mb-0" style="font-size: 0.75rem;" title="{{ $gal->keterangan }}">{{ $gal->keterangan }}</p>
                                    @endif
                                </div>
                                <div class="mt-2 pt-2 border-top text-muted" style="font-size: 0.7rem;">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $gal->created_at ? $gal->created_at->format('d/m/Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-secondary">
                        <i class="bi bi-camera fs-1 d-block mb-2"></i>
                        Belum ada foto dokumentasi.
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2 bg-light d-flex justify-content-end">
                <button type="button" class="btn btn-secondary rounded-pill px-4 py-1 small fw-semibold" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection