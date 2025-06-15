@extends('layouts.app')

@section('title', 'Kontak')

@section('main')
    <section class="py-5 bg-sky-900 text-white mt-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Hubungi Kami</h2>
            <p class="fst-italic">Silakan hubungi kantor pusat kami untuk pertanyaan dan dukungan.</p>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('img/contact.jpg') }}" alt="Kontak" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold text-sky-900 mb-3">Alamat Kantor Pusat</h3>
                    <p class="mb-2"><strong>PT. BAHANA MEGA PRESTASI</strong></p>
                    <p class="mb-2">Jln. Raya Kodau No. 42, Jati Asih, Jati Mekar,<br>Kota Bekasi, Jawa Barat – INDONESIA</p>
                    <p class="mb-0">Telepon: +62 21 8497 8899</p>
                </div>
            </div>
        </div>
    </section>
@endsection
