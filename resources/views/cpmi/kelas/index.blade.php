@extends('layouts.cpmi')

@section('title', 'Kelas')

@section('main')
    <section class="container py-5 mt-5 min-vh-100">
        <div class="row justify-content-center">
            <div class="col-lg-4 mb-3">
                <div class="card bg-white shadow-sm">
                    <div class="card-header text-center fw-bold">
                        Lokasi
                    </div>
                    <div class="card-body text-center">
                        <i class="bi bi-building d-block text-sky-900" style="font-size: 70px"></i>
                        <p class="mb-1 fw-bold">Lokasi</p> 
                        <p class="mb-1">{{ $cpmi->kelas->lokasi->nama }}</p> 
                        <p class="mb-1 fw-bold">Alamat</p> 
                        <p class="mb-1">{{ $cpmi->kelas->lokasi->alamat }}</p>
                        <p class="mb-1 fw-bold">Telepon</p> 
                        <p class="mb-1">{{ $cpmi->kelas->lokasi->telepon }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-3">
                <div class="card bg-white shadow-sm">
                    <div class="card-header text-center fw-bold">
                        Jadwal Kelas {{ $cpmi->kelas->nama ?? '-' }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Hari</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Pengajar</th>
                                        <th>Libur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cpmi->kelas?->jadwalPelajaran ?? [] as $jadwal)
                                        <tr>
                                            <td class="text-center">{{ $jadwal->hari }}</td>
                                            <td>{{ $jadwal->mataPelajaran->nama ?? '-' }}</td>
                                            <td>{{ $jadwal->pengajar->name ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($jadwal->libur)
                                                    <i class="bi bi-x-circle-fill text-danger" title="Libur"></i>
                                                @else
                                                    <i class="bi bi-check-circle-fill text-success" title="Aktif"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Tidak ada jadwal tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
