{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Upload Galeri - PT Solusi Koneksi Anda')

@section('content')
<div class="mx-auto" style="max-width: 700px;">
    {{-- Header halaman & tombol kembali ke daftar galeri --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font fw-bold text-dark mb-0">Upload Foto Galeri Kegiatan</h3>
        <a href="{{ route('galeri.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Notifikasi validasi error input --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 py-3 px-4 mb-4" style="background-color: #fef2f2; color: #b91c1c;">
            <div class="d-flex align-items-center gap-2 mb-1 fw-bold">
                <i class="bi bi-exclamation-octagon-fill"></i>
                <span>Terdapat kesalahan pada isian galeri:</span>
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
        {{-- Form upload galeri baru (method POST) --}}
        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Input judul / keterangan kegiatan --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Judul Kegiatan / Keterangan Foto</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required placeholder="Contoh: Instalasi Rack Server & WiFi 6 di Klien">
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Input upload file gambar & preview --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">File Gambar Kegiatan</label>
                <div id="previewContainer" class="mb-2 d-none">
                    <img id="imagePreview" src="#" alt="Pratinjau Foto" class="rounded-3 border shadow-sm" style="max-height: 180px; max-width: 280px; object-fit: cover;">
                </div>
                <input type="file" name="gambar" id="gambarInput" accept="image/*" class="form-control @error('gambar') is-invalid @enderror" required onchange="previewFile(this)">
                <small class="text-muted" style="font-size: 0.75rem;">Format: JPG, JPEG, PNG, WEBP (Maks. 3MB).</small>
                @error('gambar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol submit upload foto --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                    <i class="bi bi-cloud-arrow-up me-1"></i> Unggah Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script JavaScript untuk preview foto kegiatan --}}
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