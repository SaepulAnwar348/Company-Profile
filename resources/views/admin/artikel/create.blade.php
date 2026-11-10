{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru')

@section('content')
{{-- Header halaman & tombol kembali --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0">Tulis Artikel Baru</h3>
    <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

    {{-- Menampilkan pesan error validasi input jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 py-3 px-4 mb-4" style="background-color: #fef2f2; color: #b91c1c;">
            <div class="d-flex align-items-center gap-2 mb-1 fw-bold">
                <i class="bi bi-exclamation-octagon-fill"></i>
                <span>Terdapat kesalahan pada isian artikel:</span>
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
        {{-- Formulir penambahan artikel baru (method POST ke artikel.store) --}}
        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Input judul artikel dan nama penulis --}}
            <div class="row g-3">
                <div class="col-md-8 mb-3">
                    <label class="form-label small fw-semibold text-secondary">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required placeholder="Contoh: Tren Jaringan Komputer Modern 2026">
                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-semibold text-secondary">Penulis</label>
                    <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis', Auth::user()->nama_lengkap ?? 'Admin') }}" required placeholder="Nama penulis">
                    @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Input upload gambar sampul artikel & pratinjau --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Upload Sampul / Gambar Ilustrasi</label>
                <div id="previewContainer" class="mb-2 d-none">
                    <img id="imagePreview" src="#" alt="Pratinjau Sampul" class="rounded-3 border shadow-sm" style="max-height: 150px; max-width: 250px; object-fit: cover;">
                </div>
                <input type="file" name="gambar" id="gambarInput" accept="image/*" class="form-control @error('gambar') is-invalid @enderror" onchange="previewFile(this)">
                <small class="text-muted" style="font-size: 0.75rem;">Format: JPG, JPEG, PNG, WEBP (Maks. 2MB). Opsional.</small>
                @error('gambar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            {{-- Input textarea teks isi lengkap artikel --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Isi Lengkap Artikel</label>
                <textarea name="isi_artikel" rows="8" class="form-control @error('isi_artikel') is-invalid @enderror" required placeholder="Tuliskan konten artikel secara detail...">{{ old('isi_artikel') }}</textarea>
                @error('isi_artikel') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol submit publikasi artikel --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                    <i class="bi bi-send me-1"></i> Publikasikan Artikel
                </button>
            </div>
        </form>
    </div>

{{-- Script JavaScript untuk preview gambar langsung sebelum disimpan --}}
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