{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Tambah Produk & Layanan - PT Solusi Koneksi Anda')
@section('page_title', 'Tambah Produk & Layanan')

@section('content')
<div class="mx-auto" style="max-width: 700px;">
    {{-- Header halaman & tombol kembali --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font fw-bold text-dark mb-0">Tambah Produk & Layanan Baru</h3>
        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">← Kembali</a>
    </div>

    {{-- Notifikasi validasi error input --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 py-3 px-4 mb-4" style="background-color: #fef2f2; color: #b91c1c;">
            <div class="d-flex align-items-center gap-2 mb-1 fw-bold">
                <i class="bi bi-exclamation-octagon-fill"></i>
                <span>Terdapat kesalahan pada input produk:</span>
            </div>
            <ul class="mb-0 ps-3 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card-netcore p-4 p-lg-5">
        {{-- Form penambahan produk (enctype multipart/form-data wajib untuk upload berkas) --}}
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- Input nama produk atau nama paket layanan --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Nama Produk / Layanan Jaringan</label>
                <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Contoh: Paket Pemasangan WiFi Enterprise / Router Core MikroTik" value="{{ old('nama_produk') }}" required>
                @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Input harga atau tarif layanan --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Harga / Tarif Layanan (Rp)</label>
                <input type="number" step="0.01" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="Contoh: 3500000" value="{{ old('harga') }}" required>
                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Input upload file foto produk & preview gambar --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Foto / Ilustrasi Produk atau Layanan</label>
                <div id="previewContainer" class="mb-2 d-none">
                    <img id="imagePreview" src="#" alt="Pratinjau Gambar" class="rounded-3 border shadow-sm" style="max-height: 140px; max-width: 200px; object-fit: cover;">
                </div>
                <input type="file" name="gambar" id="gambarInput" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" onchange="previewFile(this)">
                <small class="text-muted" style="font-size: 0.75rem;">Format: JPG, JPEG, PNG, WEBP (Maks. 2MB). Opsional.</small>
                @error('gambar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            {{-- Input textarea spesifikasi & rincian deskripsi --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Deskripsi & Spesifikasi Lengkap</label>
                <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Jelaskan detail spesifikasi perangkat atau cakupan layanan yang diberikan..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol submit simpan data --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                    <i class="bi bi-plus-circle me-1"></i> Simpan Produk / Layanan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script JavaScript untuk preview gambar langsung --}}
<script>
    function previewFile(input) {
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('previewContainer');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            container.classList.add('d-none');
        }
    }
</script>
@endsection