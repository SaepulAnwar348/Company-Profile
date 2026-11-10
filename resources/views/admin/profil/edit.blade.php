{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Profil Perusahaan - PT Solusi Koneksi Anda')
@section('page_title', 'Profil Perusahaan')

@section('content')
<div class="mx-auto" style="max-width: 900px;">
    {{-- Header judul halaman --}}
    <div class="mb-4">
        <h3 class="brand-font fw-bold text-dark mb-1">Profil Perusahaan</h3>
        <p class="text-muted small">Kelola informasi publik dan kontak resmi perusahaan yang akan ditampilkan pada portal.</p>
    </div>

    {{-- Notifikasi validasi error input --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 py-3 px-4 mb-4" style="background-color: #fef2f2; color: #b91c1c;">
            <div class="d-flex align-items-center gap-2 mb-1 fw-bold">
                <i class="bi bi-exclamation-octagon-fill"></i>
                <span>Terdapat kesalahan pada isian formulir:</span>
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
        {{-- Form edit profil perusahaan (method PUT) --}}
        <form action="{{ route('admin.profil.update', $profil->id_profil ?? 1) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Input nama perusahaan --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $profil->nama_perusahaan ?? '') }}" required class="form-control @error('nama_perusahaan') is-invalid @enderror" placeholder="Contoh: PT Solusi Koneksi Anda">
                @error('nama_perusahaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Input deskripsi tentang perusahaan --}}
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary mb-1">Deskripsi Perusahaan</label>
                <div class="text-muted small mb-2" style="font-size: 0.75rem;">Gambaran umum dan profil operasional perusahaan.</div>
                <textarea name="tentang_kami" rows="4" class="form-control @error('tentang_kami') is-invalid @enderror" placeholder="Masukkan deskripsi perusahaan..." required>{{ old('tentang_kami', $profil->tentang_kami ?? '') }}</textarea>
                @error('tentang_kami') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr class="my-4 text-secondary opacity-25">

            {{-- Input visi dan misi perusahaan --}}
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-secondary">Visi</label>
                    <textarea name="visi" rows="3" class="form-control @error('visi') is-invalid @enderror" placeholder="Masukkan visi perusahaan..." required>{{ old('visi', $profil->visi ?? '') }}</textarea>
                    @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-secondary">Misi</label>
                    <textarea name="misi" rows="3" class="form-control @error('misi') is-invalid @enderror" placeholder="Masukkan misi perusahaan..." required>{{ old('misi', $profil->misi ?? '') }}</textarea>
                    @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <hr class="my-4 text-secondary opacity-25">

            {{-- Input alamat kantor --}}
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Alamat Kantor Pusat</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-geo-alt text-muted"></i></span>
                    <input type="text" name="alamat" value="{{ old('alamat', $profil->alamat ?? '') }}" class="form-control @error('alamat') is-invalid @enderror" required placeholder="Alamat lengkap kantor">
                </div>
                @error('alamat') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Input kontak email dan no telp/whatsapp --}}
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-secondary">Email Operasional</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" value="{{ old('email', $profil->email ?? '') }}" class="form-control @error('email') is-invalid @enderror" required placeholder="info@perusahaan.com">
                    </div>
                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold text-secondary">No. Telepon / Hotline</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-telephone text-muted"></i></span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $profil->no_hp ?? '') }}" class="form-control @error('no_hp') is-invalid @enderror" required placeholder="08xxxxxxxxxx">
                    </div>
                    @error('no_hp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Tombol simpan perubahan profil --}}
            <div class="text-end pt-3">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                    <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection