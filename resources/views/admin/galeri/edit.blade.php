{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Edit Galeri - PT Solusi Koneksi Anda')

@section('content')
<div class="mx-auto" style="max-width: 700px;">
    {{-- Header halaman & tombol kembali ke daftar galeri --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font fw-bold text-dark mb-0">Edit Galeri Kegiatan</h3>
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
        {{-- Form edit galeri (method PUT untuk update) --}}
        <form action="{{ route('galeri.update', $galeri->id_galeri) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Input judul / keterangan kegiatan --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Judul Kegiatan / Keterangan Foto</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $galeri->judul) }}" required>
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Input ganti gambar baru & preview gambar lama --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Ganti Gambar (Opsional)</label>
                <div class="d-flex align-items-center gap-3 mb-2">
                    @if($galeri->gambar && (file_exists(public_path('storage/' . $galeri->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($galeri->gambar)))
                        <div>
                            <small class="text-muted d-block mb-1">Saat Ini:</small>
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" class="rounded-3 border shadow-sm" style="width: 130px; height: 85px; object-fit: cover;">
                        </div>
                    @endif
                    <div id="previewContainer" class="d-none">
                        <small class="text-primary d-block mb-1 fw-semibold">Baru (Pratinjau):</small>
                        <img id="imagePreview" src="#" alt="Pratinjau Foto Baru" class="rounded-3 border border-primary shadow-sm" style="width: 130px; height: 85px; object-fit: cover;">
                    </div>
                </div>
                <input type="file" name="gambar" id="gambarInput" accept="image/*" class="form-control @error('gambar') is-invalid @enderror" onchange="previewFile(this)">
                <small class="text-muted" style="font-size: 0.75rem;">Biarkan kosong jika tidak ingin mengganti gambar (Format: JPG, JPEG, PNG, WEBP, Maks. 3MB).</small>
                @error('gambar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol submit simpan perubahan --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script JavaScript untuk preview foto baru sebelum disimpan --}}
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