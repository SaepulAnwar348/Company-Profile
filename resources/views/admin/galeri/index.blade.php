{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Kelola Galeri - PT Solusi Koneksi Anda')
@section('page_title', 'Galeri')

@section('content')
{{-- Header halaman & tombol tambah kegiatan galeri --}}
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h3 class="brand-font fw-bold text-dark mb-1">Kelola Galeri Kegiatan</h3>
        <p class="text-muted small mb-0">Dokumentasi aktivitas dan agenda resmi perusahaan.</p>
    </div>
    <a href="{{ route('galeri.create') }}" class="btn btn-primary rounded-pill px-4 py-2 small fw-semibold d-inline-flex align-items-center gap-2" style="background-color: var(--brand-blue); border: none;">
        <i class="bi bi-plus-circle"></i>
        <span>Tambah Kegiatan</span>
    </a>
</div>

{{-- Formulir pencarian data galeri --}}
<div class="card-netcore p-3 mb-4">
    <form action="{{ route('galeri.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-9 col-sm-8">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-start-0 ps-0" placeholder="Cari nama agenda atau judul dokumentasi...">
            </div>
        </div>
        <div class="col-md-3 col-sm-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 rounded-3 small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary rounded-3" title="Reset Pencarian">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Tabel daftar galeri kegiatan dari database --}}
<div class="card-netcore overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-secondary text-uppercase small" style="font-size: 0.75rem;">
                <tr>
                    <th class="ps-4 py-3 text-center" style="width: 65px;">No.</th>
                    <th class="py-3">Foto & Judul Kegiatan</th>
                    <th class="text-end pe-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="small">
                {{-- Looping data galeri --}}
                @forelse($galeri as $item)
                <tr>
                    {{-- Kolom angka nomor urut --}}
                    <td class="ps-4 py-3 text-center fw-bold text-secondary" style="width: 65px;">
                        {{ $loop->iteration + ($galeri->firstItem() ? $galeri->firstItem() - 1 : 0) }}
                    </td>
                    {{-- Kolom foto dan judul kegiatan --}}
                    <td class="py-3">
                        <div class="d-flex align-items-center gap-3">
                            @if($item->gambar && (file_exists(public_path('storage/' . $item->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($item->gambar)))
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="rounded-3 border object-fit-cover shadow-sm flex-shrink-0" style="width: 58px; height: 58px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imgModalGaleri{{ $item->id_galeri }}" title="Klik untuk perbesar">
                                
                                {{-- Modal perbesar foto dokumentasi --}}
                                <div class="modal fade" id="imgModalGaleri{{ $item->id_galeri }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                            <div class="modal-header border-0 pb-0">
                                                <h6 class="modal-title fw-bold text-dark">{{ $item->judul }}</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center p-3">
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="img-fluid rounded-3" style="max-height: 500px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="rounded-3 bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 58px; height: 58px;">
                                    <i class="bi bi-camera fs-4"></i>
                                </div>
                            @endif
                            <div>
                                <span class="fw-bold text-dark d-block mb-1">{{ $item->judul }}</span>
                                <span class="badge bg-light text-secondary border" style="font-size: 0.72rem;">Dokumentasi Resmi</span>
                            </div>
                        </div>
                    </td>
                    {{-- Kolom tombol aksi edit dan hapus --}}
                    <td class="text-end pe-4">
                        <div class="d-inline-flex gap-1">
                            {{-- Tombol edit --}}
                            <a href="{{ route('galeri.edit', $item->id_galeri) }}" class="btn btn-sm btn-light text-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                            {{-- Tombol hapus --}}
                            <form action="{{ route('galeri.destroy', $item->id_galeri) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus dokumentasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                {{-- Tampilan jika data galeri kosong --}}
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted">
                        @if(request('search'))
                            Tidak ada dokumentasi kegiatan yang cocok dengan "<strong>{{ request('search') }}</strong>".
                        @else
                            Belum ada agenda galeri yang disimpan.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Navigasi Tombol ke Slide / Halaman Lain --}}
    @include('admin.partials.slide-pagination', ['paginator' => $galeri])
</div>
@endsection