@extends('layouts.auth')

@section('title', 'Registrasi')

@section('main')
<main class="bg-sky-900 py-5">
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="mb-3" style="height: 80px;">
                            <h3 class="text-sky-900 fw-bold">Registrasi</h3>
                        </div>
                        <form id="registrasi" autocomplete="off">
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" id="nama">
                                <small class="invalid-feedback" id="errornama"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email">
                                <small class="invalid-feedback" id="erroremail"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="telepon">Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="telepon" id="telepon">
                                <small class="invalid-feedback" id="errortelepon"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                                <small class="invalid-feedback" id="erroralamat"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="lokasi">Lokasi <span class="text-danger">*</span></label>
                                <select name="lokasi" id="lokasi" class="form-select">
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach ($lokasi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="invalid-feedback" id="errorlokasi"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password">
                                <small class="invalid-feedback" id="errorpassword"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="konfirmasi_password">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
                                <small class="invalid-feedback" id="errorkonfirmasi_password"></small>
                            </div>
                            <div class="form-group d-grid">
                                <button type="submit" class="btn btn-sky-900">Registrasi</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-sky-900 ">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
