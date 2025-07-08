
@extends('layouts.cpmi')

@section('title', 'CPMI')

@section('main')
    <section class="container py-5 mt-5 min-vh-100">
        <div class="row justify-content-center">
            <div class="col-lg-4 mb-3">
                <div class="card bg-white shadow-sm">
                    <div class="card-header text-center fw-bold">
                        Profile
                    </div>
                    <div class="card-body text-center">
                        <i class="bi bi-person-circle d-block text-sky-900" style="font-size: 70px"></i>
                        <p class="mb-1 fw-bold">Nama</p> 
                        <p class="mb-1">{{ $cpmi->nama }}</p> 
                        <p class="mb-1 fw-bold">Lokasi</p> 
                        <p class="mb-1">{{ $cpmi->lokasi->nama }}</p>
                        <p class="mb-1 fw-bold">Kelas</p> 
                        <p class="mb-1">{{ $cpmi->kelas->nama }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="/" class="btn btn-danger d-block">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-3">
                <div class="card bg-white shadow-sm mb-3">
                    <div class="card-header text-center fw-bold">
                        Ubah Profile
                    </div>
                    <div class="card-body">
                        <form id="ubah-profile" autocomplete="off">
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $cpmi->email }}">
                                <small class="invalid-feedback" id="erroremail"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="telepon">Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="telepon" id="telepon" value="{{ $cpmi->telepon }}">
                                <small class="invalid-feedback" id="errortelepon"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ $cpmi->alamat }}</textarea>
                                <small class="invalid-feedback" id="erroralamat"></small>
                            </div>
                            <div class="form-group d-grid">
                                <button type="submit" class="btn btn-sky-900">Ubah Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card bg-white shadow-sm">
                    <div class="card-header text-center fw-bold">
                        Ubah Password
                    </div>
                    <div class="card-body">
                        <form id="ubah-password" autocomplete="off">
                            <div class="form-group mb-3">
                                <label class="form-label" for="password_lama">Password Lama <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_lama" id="password_lama">
                                <small class="invalid-feedback" id="errorpassword_lama"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password_baru">Password  Baru<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_baru" id="password_baru">
                                <small class="invalid-feedback" id="errorpassword_baru"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="konfirmasi_password_baru">Konfirmasi Passwordc Baru <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="konfirmasi_password_baru" id="konfirmasi_password_baru">
                                <small class="invalid-feedback" id="errorkonfirmasi_password_baru"></small>
                            </div>
                            <div class="form-group d-grid">
                                <button type="submit" class="btn btn-sky-900">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>   
@endsection
