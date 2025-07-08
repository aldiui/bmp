@extends('layouts.cpmi')

@section('title', 'Absensi')

@section('main')
    <section class="container py-5 mt-5 min-vh-100">
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <input type="hidden" id="latitude" value="{{ $cpmi->lokasi->latitude ?? '' }}">
                <input type="hidden" id="longitude" value="{{ $cpmi->lokasi->longitude ?? '' }}">
                <input type="hidden" id="nama_lokasi" value="{{ $cpmi->lokasi->nama ?? 'Lokasi Tidak Dikenal' }}">
                <input type="hidden" id="radius" value="{{ $cpmi->lokasi->radius ?? 100 }}">

                <div class="card shadow-sm bg-white border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <div class="text-muted small">
                                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                            </div>
                            <div class="text-muted small fw-semibold" id="jam">--:--:--</div>
                        </div>
                        <div id="map" class="rounded mb-3" style="height: 450px;"></div>
                        <input type="hidden" name="lokasi" id="lokasi">
                        <div class="d-grid gap-2">
                            <button type="submit" id="absensiButton"
                                class="btn {{ $absensi ? ($absensi->jam_keluar == null ? 'btn-danger' : 'btn-secondary') : 'btn-success' }}"
                                {{ $absensi && $absensi->jam_keluar != null ? 'disabled' : '' }}>
                                {{ $absensi ? ($absensi->jam_keluar == null ? 'Absensi Keluar' : 'Sudah Absensi') : 'Absensi Masuk' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  div class="card shadow-sm bg-white">
            <div class="card-header fw-bold text-center">
                Daftar Absensi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="absensi-table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Absensi Masuk</th>
                                <th>Absensi Pulang</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('#absensi-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("cpmi.absensi.datatable") }}',
                data: function (d) {
                    d.bulan = $('#bulan').val();
                    d.tahun = $('#tahun').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'jam_masuk', name: 'jam_masuk' },
                { data: 'jam_keluar', name: 'jam_keluar' },
            ]
        });
    </script>
    <div class="modal fade" role="dialog" id="alasanModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alasan
                {{ $absensi ? ($absensi->jam_keluar == null ? 'Absensi Keluar' : 'Sudah Absensi') : 'Absensi Masuk' }}
                    </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="alasan">Alasan <span class="text-danger">*</span></label>
                        <textarea name="alasan" id="alasan" class="form-control" rows="3"></textarea>
                        <small class="invalid-feedback" id="erroralasan"></small>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="cleanInput('#alasan')">Batal</button>
                    <button type="submit" class="btn btn-success" id="saveAlasan">Simpan</button>
                </div>
            </div>
        </div>
    </div>

@endsection
