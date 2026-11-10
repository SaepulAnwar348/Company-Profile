{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Edit Artikel - PT Solusi Koneksi Anda')

@section('content')
<div class="mx-auto" style="max-width: 900px;">
    {{-- Header judul halaman & tombol kembali ke daftar --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font fw-bold text-dark mb-0">Edit Artikel</h3>
        <a href="{{ route('artikel.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Notifikasi pesan kesalahan jika validasi input gagal --}}
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
        {{-- Form edit artikel (method PUT untuk update data ke database) --}}
        <form action="{{ route('artikel.update', $artikel->id_artikel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Input judul artikel dan nama penulis --}}
            <div class="row g-3">
                <div class="col-md-8 mb-3">
                    <label class="form-label small fw-semibold text-secondary">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $artikel->judul) }}" required>
                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label small fw-semibold text-secondary">Penulis</label>
                    <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis', $artikel->penulis) }}" required>
                    @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Input ganti gambar sampul & pratinjau (preview) --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Ganti Sampul (Biarkan kosong jika tidak diubah)</label>
                <div class="d-flex align-items-center gap-3 mb-2">
                    {{-- Tampilan gambar saat ini jika ada di storage --}}
                    @if($artikel->gambar && (file_exists(public_path('storage/' . $artikel->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($artikel->gambar)))
                        <div>
                            <small class="text-muted d-block mb-1">Saat Ini:</small>
                            <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="rounded-3 border shadow-sm" style="width: 100px; height: 65px; object-fit: cover;">
                        </div>
                    @endif
                    {{-- Tampilan pratinjau gambar baru yang baru dipilih --}}
                    <div id="previewContainer" class="d-none">
                        <small class="text-primary d-block mb-1 fw-semibold">Baru (Pratinjau):</small>
                        <img id="imagePreview" src="#" alt="Pratinjau Sampul Baru" class="rounded-3 border border-primary shadow-sm" style="width: 100px; height: 65px; object-fit: cover;">
                    </div>
                </div>
                <input type="file" name="gambar" id="gambarInput" accept="image/*" class="form-control @error('gambar') is-invalid @enderror" onchange="previewFile(this)">
                <small class="text-muted" style="font-size: 0.75rem;">Format: JPG, JPEG, PNG, WEBP (Maks. 2MB).</small>
                @error('gambar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            {{-- Input textarea isi teks lengkap artikel --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Isi Lengkap Artikel</label>
                <textarea name="isi_artikel" rows="8" class="form-control @error('isi_artikel') is-invalid @enderror" required>{{ old('isi_artikel', $artikel->isi_artikel) }}</textarea>
                @error('isi_artikel') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol simpan perubahan artikel --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                    <i class="bi bi-save me-1"></i> Perbarui Artikel
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script JavaScript untuk menampilkan pratinjau langsung gambar yang dipilih --}}
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