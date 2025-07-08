@extends('layouts.cpmi')

@section('title', $lowonganKerja->nama)

@section('main')
<section class="container py-5 mt-5 min-vh-100">
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm bg-white rounded-3">
                <div class="row g-0">
                    <div class="col-md-5">
                        <div style="height: 100%; background-size: cover; background-position: center; background-image: url('{{ asset('img/default-job.jpg') }}');">

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">{{ $lowonganKerja->nama }}</h4>

                            <div class="mb-2 text-muted">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ $lowonganKerja->negara->nama ?? '-' }}
                            </div>

                            <div class="mb-2 text-muted">
                                <i class="bi bi-tags me-1"></i>
                                {{ $lowonganKerja->kategori->nama ?? '-' }}
                            </div>

                            <div class="mb-3">
                                <span class="badge 
                                    @if ($lowonganKerja->status_loker === 'Urgent') bg-danger
                                    @elseif ($lowonganKerja->status_loker === 'Normal') bg-warning text-dark
                                    @else bg-secondary
                                    @endif">
                                    {{ $lowonganKerja->status_loker }}
                                </span>

                                <span class="badge bg-info text-dark">
                                    @if ($lowonganKerja->status_kuota === 'Unlimited')
                                        Kuota Tidak Terbatas
                                    @else
                                        Kuota {{ $lowonganKerja->kuota ?? '-' }}
                                    @endif
                                </span>
                            </div>

                            @if ($lowonganKerja->tampilkan_gaji && $lowonganKerja->gaji_awal && $lowonganKerja->gaji_akhir)
                                <p class="fw-semibold text-success">
                                    <i class="bi bi-cash-coin me-1"></i>
                                    {{ $lowonganKerja->negara->simbol_mata_uang ?? '' }}{{ number_format($lowonganKerja->gaji_awal, 0, ',', '.') }}
                                    -
                                    {{ $lowonganKerja->negara->simbol_mata_uang ?? '' }}{{ number_format($lowonganKerja->gaji_akhir, 0, ',', '.') }}
                                </p>
                            @endif

                            <p class="mt-3 mb-2 text-muted small">
                                <i class="bi bi-person-lines-fill me-1"></i>
                                {{ $lowonganKerja->lamaranKerja->count() }} Pelamar
                            </p>
                            <input type="hidden" name="slug" id="slug" value="{{ $lowonganKerja->slug }}">

                            @if($cpmi->lamaranKerja->where('lowongan_kerja_id', $lowonganKerja->id)->where('cpmi_id', $cpmi->id)->first())
                                <p class="text-success">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Kamu Telah Melamar Pekerjaan Ini
                                </p>
                            @else
                                <div class="mt-4">
                                    <form id="lamaran-kerja" autocomplete="off">
                                        <input type="hidden" name="lowongan_kerja" value="{{ $lowonganKerja->id }}">
                                        <button type="submit"  class="btn btn-sky-900 w-100">
                                            <i class="bi bi-send-check me-1"></i> Lamar Pekerjaan
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($lowonganKerja->persyaratan)
                    <div class="card-footer bg-white px-4 pt-4 pb-3">
                        <h5 class="fw-bold">Persyaratan Pekerjaan</h5>
                        <p class="text-muted">{!! $lowonganKerja->persyaratan !!}</p>
                    </div>    
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
