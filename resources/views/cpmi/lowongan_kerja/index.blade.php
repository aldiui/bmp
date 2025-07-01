@extends('layouts.cpmi')

@section('title', 'Lowongan Kerja')

@section('main')
    <section class="container py-5 mt-5 min-vh-100">
        <div class="row justify-content-center mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-sky-900 mb-4">Lowongan Kerja</h2>
            </div>
            <div class="col-12">
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-12 col-md-6 col-lg-6">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Cari Lowongan Kerja...">
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <select name="kategori" id="kategori" class="form-select">
                                    <option value="Semua">Semua Kategori</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <select name="negara" id="negara" class="form-select">
                                    <option value="Semua">Semua Negara</option>
                                    @foreach ($negara as $n)
                                        <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="lowongan-kerja">
        </div>
    </section>
@endsection
