{{-- 
    Komponen Navigasi Slide / Halaman (Pagination)
    Menampilkan info rentang data (maksimal 10 per slide), 
    tombol Slide Sebelumnya, tombol nomor Slide 1..N, dan tombol Slide Berikutnya
--}}
<div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
    <div class="small text-muted">
        @if($paginator->total() > 0)
            Menampilkan data ke-<strong>{{ $paginator->firstItem() ?? 1 }}</strong> sampai <strong>{{ $paginator->lastItem() ?? $paginator->total() }}</strong> dari total <strong>{{ $paginator->total() }}</strong> data (Batas 10 per slide)
        @else
            Menampilkan <strong>0</strong> data
        @endif
    </div>

    <nav aria-label="Navigasi Slide Halaman">
        <ul class="pagination pagination-sm mb-0 gap-1 align-items-center">
            {{-- Tombol Slide Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link rounded-2 px-3 py-1 text-muted border bg-light" style="font-size: 0.82rem;">
                        <i class="bi bi-chevron-left me-1"></i> Slide Sebelumnya
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-2 px-3 py-1 text-primary border bg-white fw-semibold" href="{{ $paginator->previousPageUrl() }}" style="font-size: 0.82rem;">
                        <i class="bi bi-chevron-left me-1"></i> Slide Sebelumnya
                    </a>
                </li>
            @endif

            {{-- Nomor-nomor Slide (Tetap tampilkan tombol Slide 1 aktif jika hanya ada 1 halaman) --}}
            @for ($i = 1; $i <= max(1, $paginator->lastPage()); $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link rounded-2 px-3 py-1 fw-bold text-white border-0 shadow-sm" style="background-color: var(--brand-blue); font-size: 0.82rem;">
                            Slide {{ $i }}
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link rounded-2 px-3 py-1 text-dark border bg-white fw-medium" href="{{ $paginator->url($i) }}" style="font-size: 0.82rem;">
                            Slide {{ $i }}
                        </a>
                    </li>
                @endif
            @endfor

            {{-- Tombol Slide Berikutnya --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-2 px-3 py-1 text-primary border bg-white fw-semibold" href="{{ $paginator->nextPageUrl() }}" style="font-size: 0.82rem;">
                        Slide Berikutnya <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link rounded-2 px-3 py-1 text-muted border bg-light" style="font-size: 0.82rem;">
                        Slide Berikutnya <i class="bi bi-chevron-right ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>

