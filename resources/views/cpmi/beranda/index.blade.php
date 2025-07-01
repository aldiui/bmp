@extends('layouts.cpmi')

@section('title', 'Beranda')

@section('main')
    @php
        $bulan = request('bulan', now()->month);
        $tahun = request('tahun', now()->year);
    @endphp

    <section class="container py-5 mt-5 min-vh-100">
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-lg-6 mb-3">
                <div class="card bg-white text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-person-circle text-sky-900 mb-3" style="font-size: 60px;"></i>
                        <h5 class="fw-bold mb-2">Selamat datang, {{ $cpmi->nama }}</h5>
                        <p class="text-muted mb-0">
                            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3 mb-3">
                <div class="card text-center bg-white shadow-sm h-100">
                    <div class="card-header fw-bold">
                        Ringkasan Absensi Bulan Ini
                    </div>
                    <div class="card-body">
                        <i class="bi bi-calendar-check-fill text-success mb-2" style="font-size: 60px;"></i>
                        <h4 class="fw-bold mt-2">
                            {{
                                $cpmi->absensi->filter(function ($absen) use ($bulan, $tahun) {
                                    return \Carbon\Carbon::parse($absen->created_at)->month == $bulan &&
                                           \Carbon\Carbon::parse($absen->created_at)->year == $tahun;
                                })->count()
                            }} Hari
                        </h4>
                        <p class="text-muted mb-0">Hadir di bulan ini</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 mb-3">
                <div class="card text-center bg-white shadow-sm h-100">
                    <div class="card-header fw-bold">
                        Lamaran Kerja
                    </div>
                    <div class="card-body">
                        <i class="bi bi-briefcase-fill text-primary mb-2" style="font-size: 60px;"></i>
                        <h4 class="fw-bold mt-2">
                            {{
                                $cpmi->lamaranKerja->filter(function ($lamaran) use ($bulan, $tahun) {
                                    return \Carbon\Carbon::parse($lamaran->created_at)->month == $bulan &&
                                        \Carbon\Carbon::parse($lamaran->created_at)->year == $tahun;
                                })->count()
                            }} Lamaran
                        </h4>
                        <p class="text-muted mb-0">Dikirim bulan ini</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm bg-white">
            <div class="card-header fw-bold text-center">
                Daftar Lamaran Kerja
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="lamaran-table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Lowongan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('#lamaran-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("cpmi.lamaranKerja.datatable") }}',
                data: function (d) {
                    d.bulan = $('#bulan').val();
                    d.tahun = $('#tahun').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'lowongan', name: 'lowongan' },
                { data: 'status', name: 'status' },
            ]
        });
    </script>
@endsection
