{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Edit Produk & Layanan - PT Solusi Koneksi Anda')
@section('page_title', 'Edit Produk & Layanan')

@section('content')
<div class="mx-auto" style="max-width: 700px;">
    {{-- Header halaman & tombol kembali --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font fw-bold text-dark mb-0">Edit Data Produk & Layanan</h3>
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
        {{-- Form edit produk (method PUT untuk update) --}}
        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Input nama produk --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Nama Produk / Layanan Jaringan</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="form-control @error('nama_produk') is-invalid @enderror" required>
                @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Input tarif/harga produk --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Harga / Tarif Layanan (Rp)</label>
                <input type="number" step="0.01" name="harga" value="{{ old('harga', $produk->harga) }}" class="form-control @error('harga') is-invalid @enderror" required>
                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Upload gambar baru & tampilan gambar lama --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Foto / Ilustrasi Produk atau Layanan</label>
                <div class="d-flex align-items-center gap-3 mb-2">
                    @if($produk->gambar && (file_exists(public_path('storage/' . $produk->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->gambar)))
                        <div>
                            <small class="text-muted d-block mb-1">Saat Ini:</small>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="rounded-3 border shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                    @endif
                    <div id="previewContainer" class="d-none">
                        <small class="text-primary d-block mb-1 fw-semibold">Baru (Pratinjau):</small>
                        <img id="imagePreview" src="#" alt="Pratinjau Gambar Baru" class="rounded-3 border border-primary shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                </div>
                <input type="file" name="gambar" id="gambarInput" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" onchange="previewFile(this)">
                <small class="text-muted" style="font-size: 0.75rem;">Biarkan kosong jika tidak ingin mengubah foto/gambar (Maks. 2MB).</small>
                @error('gambar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            {{-- Input textarea spesifikasi deskripsi --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Deskripsi & Spesifikasi Lengkap</label>
                <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tombol submit simpan perubahan --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                    <i class="bi bi-save me-1"></i> Perbarui Produk & Layanan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script JavaScript untuk preview gambar baru --}}
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