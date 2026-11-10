{{-- Menggunakan template layout master admin --}}
@extends('layouts.admin')

@section('title', 'Kelola Pesan Masuk - PT Solusi Koneksi Anda')
@section('page_title', 'Pesan Masuk')

@section('content')
{{-- Styling tampilan antarmuka kotak masuk (inbox layout 2 kolom) --}}
<style>
    .inbox-card-container {
        height: calc(100vh - 230px);
        min-height: 650px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }
    .inbox-list-scroll {
        overflow-y: auto;
        height: calc(100% - 130px);
    }
    .inbox-item {
        border-left: 4px solid transparent;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .inbox-item:hover {
        background-color: #f8fafc;
        border-left-color: #cbd5e1;
    }
    .inbox-item.active {
        background-color: #eff6ff;
        border-left-color: var(--brand-blue);
    }
    .inbox-item.active .inbox-sender-name {
        color: var(--brand-blue);
        font-weight: 700;
    }
    .inbox-body-scroll {
        overflow-y: auto;
        height: calc(100% - 160px);
    }
    .avatar-gradient {
        background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
        color: #ffffff;
        font-weight: 700;
    }
    .message-bubble {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    }
    .inbox-list-scroll::-webkit-scrollbar,
    .inbox-body-scroll::-webkit-scrollbar {
        width: 5px;
    }
    .inbox-list-scroll::-webkit-scrollbar-track,
    .inbox-body-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .inbox-list-scroll::-webkit-scrollbar-thumb,
    .inbox-body-scroll::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 4px;
    }
    .inbox-list-scroll::-webkit-scrollbar-thumb:hover,
    .inbox-body-scroll::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>

{{-- Header halaman & kartu indikator total pesan --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h3 class="brand-font fw-bold text-dark mb-1">Kelola Pesan Masuk</h3>
        <p class="text-muted small mb-0">Daftar pertanyaan dan pesan yang masuk melalui formulir kontak website.</p>
    </div>
    
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-xs d-inline-flex align-items-center gap-2">
            <i class="bi bi-inbox-fill text-primary"></i>
            <span class="text-muted">Total:</span>
            <strong class="text-dark">{{ $totalPesan }} Pesan</strong>
        </span>
    </div>
</div>

{{-- Container utama inbox 2 kolom (Kiri: daftar pesan, Kanan: detail pesan) --}}
<div class="inbox-card-container">
    <div class="row g-0 h-100">
        
        {{-- KOLOM KIRI: Pencarian & daftar ringkasan pesan masuk --}}
        <div class="col-md-5 col-lg-4 border-end d-flex flex-column h-100 bg-white">
            
            {{-- Header kolom kiri & formulir pencarian pesan --}}
            <div class="p-3 border-bottom bg-light bg-opacity-50">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">Kotak Masuk</span>
                        <span class="badge bg-primary rounded-pill small px-2 py-0.5">{{ $kontak->count() }}</span>
                    </div>
                    @if(request('search'))
                        <a href="{{ route('admin.kontak.index') }}" class="small text-decoration-none text-muted" title="Reset filter">
                            <i class="bi bi-x-circle me-1"></i>Reset
                        </a>
                    @endif
                </div>

                {{-- Input pencarian pesan --}}
                <form action="{{ route('admin.kontak.index') }}" method="GET" class="position-relative">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm ps-5 pe-4 py-2 bg-white rounded-pill" placeholder="Cari nama, email, pesan..." style="font-size: 0.82rem;">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 0.85rem;"></i>
                    @if(request('search'))
                        <a href="{{ route('admin.kontak.index') }}" class="position-absolute top-50 end-0 translate-middle-y me-3 text-secondary text-decoration-none" style="font-size: 0.85rem;">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </form>
            </div>

            {{-- Daftar item pesan masuk (dapat di-scroll) --}}
            <div class="inbox-list-scroll flex-grow-1">
                @forelse($kontak as $item)
                    @php
                        $isActive = ($selected && $selected->id_kontak == $item->id_kontak);
                    @endphp
                    <a href="{{ route('admin.kontak.index', ['id' => $item->id_kontak, 'search' => request('search')]) }}" 
                       class="inbox-item p-3 border-bottom {{ $isActive ? 'active' : '' }}">
                        <div class="d-flex gap-3 align-items-start">
                            {{-- Avatar inisial nama pengirim --}}
                            <div class="rounded-circle avatar-gradient d-flex align-items-center justify-content-center flex-shrink-0 small" style="width: 38px; height: 38px; font-size: 0.82rem;">
                                {{ strtoupper(substr($item->nama_pengirim, 0, 2)) }}
                            </div>

                            {{-- Cuplikan pesan --}}
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="inbox-sender-name text-truncate small fw-semibold text-dark">
                                        {{ $item->nama_pengirim }}
                                    </div>
                                    @if($item->created_at)
                                    <span class="text-muted text-nowrap ms-1" style="font-size: 0.7rem;">
                                        <i class="bi bi-clock me-0.5"></i>{{ $item->created_at->isToday() ? $item->created_at->format('H:i') . ' WIB' : $item->created_at->translatedFormat('d M, H:i') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="fw-semibold text-secondary small text-truncate mb-1" style="font-size: 0.78rem;">
                                    {{ $item->subjek }}
                                </div>
                                <div class="text-muted text-truncate" style="font-size: 0.75rem; line-height: 1.3;">
                                    {{ Str::limit($item->isi_pesan, 60) }}
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- Tampilan saat tidak ada pesan masuk --}}
                    <div class="text-center py-5 px-3 text-muted my-auto">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3 text-secondary" style="width: 54px; height: 54px;">
                            <i class="bi bi-inbox fs-3 opacity-50"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Kotak Masuk Kosong</h6>
                        <p class="small mb-0">
                            @if(request('search'))
                                Tidak ditemukan pesan yang sesuai.
                                <br>
                                <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm btn-outline-primary mt-2 rounded-pill">
                                    Tampilkan Semua Pesan
                                </a>
                            @else
                                Belum ada pesan atau pertanyaan dari pengunjung website.
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="p-2.5 border-top bg-light bg-opacity-40 text-center text-muted small" style="font-size: 0.75rem;">
                Menampilkan {{ $kontak->count() }} pesan
            </div>
        </div>

        {{-- KOLOM KANAN: Detail isi pesan yang dipilih & aksi balas/hapus --}}
        <div class="col-md-7 col-lg-8 d-flex flex-column h-100 bg-white">
            @if($selected)
                {{-- Header detail pesan & tombol aksi --}}
                <div class="p-4 border-bottom bg-light bg-opacity-30">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-3">
                        <div>
                            <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 rounded-pill small fw-semibold">
                                    <i class="bi bi-tag-fill me-1"></i>Pesan Masuk
                                </span>
                                @if($selected->created_at)
                                <span class="badge bg-secondary-subtle text-secondary-emphasis border px-2.5 py-1 rounded-pill small fw-normal">
                                    <i class="bi bi-clock-history me-1 text-primary"></i>Diterima: {{ $selected->created_at->translatedFormat('d F Y, H:i') }} WIB ({{ $selected->created_at->diffForHumans() }})
                                </span>
                                @endif
                            </div>
                            <h4 class="brand-font fw-bold text-dark fs-5 mb-0">{{ $selected->subjek }}</h4>
                        </div>

                        {{-- Tombol salin email & hapus pesan --}}
                        <div class="d-flex align-items-center gap-2">
                            {{-- Tombol salin email pengirim --}}
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1.5 d-inline-flex align-items-center gap-1.5 small fw-semibold" onclick="copySenderEmail('{{ $selected->email_pengirim }}', this)">
                                <i class="bi bi-clipboard"></i>
                                <span>Salin Email</span>
                            </button>

                            {{-- Tombol hapus pesan --}}
                            <form action="{{ route('admin.kontak.destroy', $selected->id_kontak) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan dari {{ $selected->nama_pengirim }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1.5 d-inline-flex align-items-center gap-1.5 small fw-semibold">
                                    <i class="bi bi-trash"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Informasi data pengirim (nama & email) --}}
                    <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded-3 shadow-xs">
                        <div class="rounded-circle avatar-gradient text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 48px; height: 48px; font-size: 1.1rem;">
                            {{ strtoupper(substr($selected->nama_pengirim, 0, 2)) }}
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="fw-bold text-dark fs-6">{{ $selected->nama_pengirim }}</span>
                                <a href="mailto:{{ $selected->email_pengirim }}" class="badge bg-light text-primary border text-decoration-none small px-2.5 py-1">
                                    <i class="bi bi-envelope-at me-1"></i>{{ $selected->email_pengirim }}
                                </a>
                            </div>
                        </div>
                        @if($selected->created_at)
                        <div class="text-end text-muted small ms-auto d-none d-sm-block flex-shrink-0">
                            <div class="fw-semibold text-dark"><i class="bi bi-calendar3 me-1 text-primary"></i>{{ $selected->created_at->translatedFormat('d F Y') }}</div>
                            <div style="font-size: 0.78rem;"><i class="bi bi-clock me-1 text-secondary"></i>{{ $selected->created_at->format('H:i') }} WIB</div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Tampilan lengkap isi pesan --}}
                <div class="inbox-body-scroll p-4 p-lg-5 flex-grow-1">
                    <div class="message-bubble p-4">
                        <div class="d-flex align-items-center gap-2 text-muted small fw-semibold text-uppercase mb-3 pb-2 border-bottom" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                            <i class="bi bi-chat-left-quote text-primary"></i>
                            <span>Isi Pesan</span>
                        </div>
                        <div class="text-dark leading-relaxed" style="line-height: 1.8; font-size: 0.95rem; white-space: pre-line; word-break: break-word;">{{ $selected->isi_pesan }}</div>
                    </div>
                </div>

                {{-- Tombol balas langsung via aplikasi email klien --}}
                <div class="p-3 border-top bg-light bg-opacity-40 d-flex flex-wrap justify-content-between align-items-center gap-3 px-4">
                    <div class="text-muted small" style="font-size: 0.78rem;">
                        <i class="bi bi-info-circle me-1"></i>Respon pesan ini langsung melalui email pengirim.
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <a href="mailto:{{ $selected->email_pengirim }}?subject=Re: {{ rawurlencode($selected->subjek) }}" class="btn btn-primary btn-sm rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 small fw-semibold text-white shadow-xs" style="background-color: var(--brand-blue); border: none;">
                            <i class="bi bi-reply-fill fs-6"></i>
                            <span>Balas via Email</span>
                        </a>
                    </div>
                </div>
            @else
                {{-- Keadaan saat belum ada pesan yang dipilih --}}
                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-center p-5 text-secondary">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3 shadow-xs" style="width: 72px; height: 72px;">
                        <i class="bi bi-envelope-paper fs-1 text-primary opacity-75"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Tidak Ada Pesan Dipilih</h5>
                    <p class="small text-muted mb-0" style="max-width: 320px;">
                        Pilih salah satu pesan di panel sebelah kiri untuk membaca isi lengkap dan memberikan balasan.
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>

{{-- Script JavaScript untuk menyalin email pengirim ke clipboard --}}
<script>
function copySenderEmail(email, button) {
    if (!navigator.clipboard) {
        const textarea = document.createElement('textarea');
        textarea.value = email;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    } else {
        navigator.clipboard.writeText(email);
    }

    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="bi bi-check-lg text-success"></i> <span class="text-success">Tersalin!</span>';
    button.classList.add('border-success');
    
    setTimeout(() => {
        button.innerHTML = originalHtml;
        button.classList.remove('border-success');
    }, 2000);
}
</script>
@endsection