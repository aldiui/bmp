<footer>
    <div class="bg-sky-800">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6 mb-3 text-center text-lg-start">
                    <img src="{{ asset('img/logo.png') }}" width="200px" class="bg-white p-3 rounded-4 mb-3" alt="Logo Perusahaan" srcset="">
                    <h5 class="mb-1 text-white fw-bold">Alamat Kantor Pusat</h5>
                    <p class="mb-1 text-white">Jln. Raya Kodau No. 42, Jati Asih, Jati Mekar, Kota Bekasi.</p>
                    <p class="mb-1 text-white">Jawa Barat - Indonesia</p>
                </div>
                <div class="col-lg-6 mb-3 text-center text-lg-end">
                    <h5 class="mb-1 mt-lg-5 text-white text-decoration-none fw-bold">Tautan Cepat</h5>
                    <a href="{{ route('home.index') }}" class="mb-1 d-block text-white text-decoration-none">Beranda</a>
                    <a href="{{ route('home.about') }}" class="mb-1 d-block text-white text-decoration-none">Tentang Kami</a>
                    <a href="{{ route('home.contact') }}" class="mb-1 d-block text-white text-decoration-none">Kontak</a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-sky-900">
        <div class="container py-4 text-center fw-bold text-white">Copyright {{ date('Y') }} - {{ config('app.name') }}
        </div>
    </div> 
</footer>