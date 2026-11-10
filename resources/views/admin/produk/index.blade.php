{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Kelola Produk & Layanan - PT Solusi Koneksi Anda')
@section('page_title', 'Produk & Layanan')

@section('content')
{{-- Header halaman & tombol tambah produk --}}
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
    <div>
        <h3 class="brand-font fw-bold text-dark mb-1">Kelola Produk & Layanan</h3>
        <p class="text-muted small mb-0">Dashboard / <span class="text-primary">Produk & Layanan</span></p>
    </div>
    <a href="{{ route('produk.create') }}" class="btn btn-primary rounded-pill px-4 py-2 small fw-semibold d-inline-flex align-items-center gap-2" style="background-color: var(--brand-blue); border: none;">
        <i class="bi bi-plus-circle"></i>
        <span>Tambah Produk / Layanan</span>
    </a>
</div>

{{-- Formulir pencarian data produk --}}
<div class="card-netcore p-3 mb-4">
    <form action="{{ route('produk.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-9 col-sm-8">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-start-0 ps-0" placeholder="Cari nama produk, jasa/layanan wifi, instalasi jaringan, dll...">
            </div>
        </div>
        <div class="col-md-3 col-sm-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 rounded-3 small fw-semibold" style="background-color: var(--brand-blue); border: none;">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary rounded-3" title="Reset Pencarian">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            @endif
        </div>
    </form>
</div>

{{-- Tabel daftar produk dari database --}}
<div class="card-netcore overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-secondary text-uppercase small" style="font-size: 0.75rem;">
                <tr>
                    <th class="ps-4 py-3 text-center" style="width: 65px;">No.</th>
                    <th class="py-3">Produk / Layanan</th>
                    <th class="py-3">Harga / Tarif</th>
                    <th class="py-3">Deskripsi & Spesifikasi</th>
                    <th class="text-end pe-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="small">
                {{-- Looping data produk --}}
                @forelse($produk as $item)
                <tr>
                    {{-- Kolom angka nomor urut --}}
                    <td class="ps-4 py-3 text-center fw-bold text-secondary" style="width: 65px;">
                        {{ $loop->iteration + ($produk->firstItem() ? $produk->firstItem() - 1 : 0) }}
                    </td>
                    {{-- Kolom gambar dan nama produk --}}
                    <td class="py-3">
                        <div class="d-flex align-items-center gap-3">
                            @if($item->gambar && (file_exists(public_path('storage/' . $item->gambar)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($item->gambar)))
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="rounded-3 border object-fit-cover shadow-sm flex-shrink-0" style="width: 48px; height: 48px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imgModalProduk{{ $item->id_produk }}" title="Klik untuk perbesar">
                                
                                {{-- Modal perbesar foto produk --}}
                                <div class="modal fade" id="imgModalProduk{{ $item->id_produk }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                                            <div class="modal-header border-0 pb-0">
                                                <h6 class="modal-title fw-bold text-dark">{{ $item->nama_produk }}</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center p-3">
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="img-fluid rounded-3" style="max-height: 400px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px;">
                                    <i class="bi bi-hdd-network fs-5"></i>
                                </div>
                            @endif
                            <div>
                                <div class="fw-bold text-dark">{{ $item->nama_produk }}</div>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis" style="font-size: 0.7rem;">Produk & Layanan</span>
                            </div>
                        </div>
                    </td>
                    {{-- Kolom harga terformat Rupiah --}}
                    <td>
                        <div class="fw-bold text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                    </td>
                    {{-- Kolom deskripsi --}}
                    <td class="text-muted text-truncate" style="max-width: 320px;">
                        {{ $item->deskripsi }}
                    </td>
                    {{-- Kolom tombol aksi edit dan hapus --}}
                    <td class="text-end pe-4">
                        <div class="d-inline-flex gap-1">
                            {{-- Tombol edit --}}
                            <a href="{{ route('produk.edit', $item->id_produk) }}" class="btn btn-sm btn-light text-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                            {{-- Tombol hapus --}}
                            <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus item produk/layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                {{-- Tampilan jika data produk kosong --}}
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        @if(request('search'))
                            Tidak ada produk/layanan yang cocok dengan kata kunci "<strong>{{ request('search') }}</strong>".
                        @else
                            Belum ada data produk atau layanan tersimpan.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Navigasi Tombol ke Slide / Halaman Lain --}}
    @include('admin.partials.slide-pagination', ['paginator' => $produk])
</div>
@endsection