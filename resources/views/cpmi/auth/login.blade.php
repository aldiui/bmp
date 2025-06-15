@extends('layouts.auth')

@section('title', 'Login')

@section('main')
<main class="bg-sky-900 py-5">
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="mb-3" style="height: 80px;">
                            <h3 class="text-sky-900 fw-bold">Login</h3>
                        </div>
                        <form id="login" autocomplete="off">
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email">
                                <small class="invalid-feedback" id="erroremail"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password">
                                <small class="invalid-feedback" id="errorpassword"></small>
                            </div>
                            <div class="form-group d-grid">
                                <button type="submit" class="btn btn-sky-900">Login</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <p class="mb-0">Belum punya akun? <a href="{{ route('auth.registrasi') }}" class="text-sky-900 ">Registrasi</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
