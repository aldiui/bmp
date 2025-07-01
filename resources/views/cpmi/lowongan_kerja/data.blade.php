@forelse ($lowonganKerja as $row)
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card shadow-sm rounded-3 bg-white h-100 overflow-hidden">
            <div style="height: 180px; background-size: cover; background-position: center; background-image: url('{{ $row->gambar ? asset('storage/' . $row->gambar) : asset('img/default-job.jpg') }}');">
            </div>
            <div class="card-body p-3">
                <h5 class="fw-bold mb-2">{{ $row->nama }}</h5>

                <p class="mb-1 text-muted small">
                    <i class="bi bi-geo-alt me-1"></i> {{ $row->negara->nama ?? '-' }}
                </p>
                <p class="mb-2 text-muted small">
                    <i class="bi bi-tags me-1"></i> {{ $row->kategori->nama ?? '-' }}
                </p>

                <div class="mb-2">
                    <span class="badge 
                        @if ($row->status_loker === 'Urgent') bg-danger
                        @elseif ($row->status_loker === 'Normal') bg-warning text-dark
                        @else bg-secondary
                        @endif">
                        {{ $row->status_loker }}
                    </span>

                    <span class="badge bg-info text-dark">
                        @if ($row->status_kuota === 'Unlimited')
                            Kuota Tidak Terbatas
                        @else
                            Kuota {{ $row->kuota ?? '-' }}
                        @endif
                    </span>
                </div>

                @if ($row->tampilkan_gaji && $row->gaji_awal && $row->gaji_akhir)
                    <p class="fw-semibold text-success mt-2 mb-0">
                        <i class="bi bi-cash-coin me-1"></i>
                        {{ $row->negara->simbol_mata_uang ?? '' }}{{ number_format($row->gaji_awal, 0, ',', '.') }} -
                        {{ $row->negara->simbol_mata_uang ?? '' }}{{ number_format($row->gaji_akhir, 0, ',', '.') }}
                    </p>
                @endif

                <p class="text-muted small mt-2 mb-0">
                    <i class="bi bi-person-lines-fill me-1"></i>
                    {{ $row->lamaranKerja->count() }} Pelamar
                </p>

                <a href="{{ route('cpmi.lowonganKerja.detail', $row->slug) }}" class="btn btn-sky-900 mt-2 w-100">
                    <i class="bi bi-send-check me-1"></i> Lamar Pekerjaan
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="text-center my-5 py-5">
            <i class="bi bi-briefcase-off-fill display-4 text-muted d-block mb-3"></i>
            <div class="fw-semibold text-muted">Lowongan Kerja Tidak Ditemukan</div>
        </div>
    </div>
@endforelse

@if ($lowonganKerja->hasPages())
    <div class="col-12">
        <div class="d-flex justify-content-center mt-4">
            {!! $lowonganKerja->links() !!}
        </div>
    </div>
@endif
