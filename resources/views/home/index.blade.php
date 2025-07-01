@extends('layouts.app')

@section('title', 'Beranda')

@section('main')
    <section class="container py-5">
        <div class="row align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-7 mb-4 mb-md-0">
                <h2 class="fw-bold display-5 mb-3 text-sky-900 text-center text-lg-start">Mitra Terpercaya Tenaga Kerja Indonesia</h2>
                <p class="text-muted">
                    PT <strong>BAHANA MEGA PRESTASI</strong> mendampingi tenaga kerja Indonesia meraih peluang terbaik di pasar global. Kami hadir dengan solusi penempatan yang cepat, aman, dan profesional.
                    <br><br>
                    Percayakan proses penyaluran tenaga kerja Anda kepada tim berpengalaman yang memahami kebutuhan industri dan tenaga kerja secara menyeluruh.
                </p>
                <div class="text-center text-lg-start mt-3">
                    <a href="{{ route('home.about') }}" class="btn btn-sky-900 rounded-pill mb-2 px-4 py-2">
                        Pelajari Selengkapnya <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                    <a href="{{ route('auth.registrasi') }}" class="btn btn-sky-500 rounded-pill mb-2 px-4 py-2 ms-2">
                        <i class="bi bi-person-plus-fill me-2"></i>Registrasi Sekarang
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center mb-3 mb-lg-0">
                <img src="{{ asset('img/ceo.jpg') }}" class="img-fluid object-fit-cover rounded" alt="CEO Doing CEO">
            </div>
        </div>
    </section>
    <section class="container py-5">
        <h2 class="fw-bold text-center mb-5 text-sky-900">Mengapa Harus Bahana ?</h2>
        <div class="row g-4 justify-content-center">
            @php
                $services = [
                    ['icon' => 'briefcase', 'title' => 'Konsultasi Karier untuk Pekerja', 'desc' => 'Kami menyediakan layanan konsultasi terstruktur untuk membantu calon pekerja migran Indonesia dalam mengidentifikasi peluang kerja yang legal, etis, dan sesuai di luar negeri. Pendekatan kami mengutamakan kesiapan, kesesuaian keterampilan, keselamatan pribadi, serta pengembangan karier jangka panjang dalam kerangka migrasi yang bertanggung jawab.'],
                    ['icon' => 'person-check', 'title' => 'Layanan Rekrutmen', 'desc' => 'Kami memberikan solusi rekrutmen khusus untuk klien internasional, mencakup pencarian kandidat, penyaringan perilaku dan keterampilan, serta pencocokan pekerjaan. Proses kami menekankan kecocokan kerja, adaptabilitas budaya, dan integritas profesional guna memastikan keandalan tenaga kerja.'],
                    ['icon' => 'file-earmark-text', 'title' => 'Dokumentasi dan Pemrosesan Legal', 'desc' => 'Kami menangani seluruh aspek dokumentasi dan pemrosesan legal untuk tenaga kerja, memastikan semua dokumen sesuai dengan peraturan yang berlaku di negara tujuan dan Indonesia. Kami mengutamakan akurasi, ketepatan waktu, dan kepatuhan hukum.'],
                    ['icon' => 'mortarboard', 'title' => 'Program Pelatihan dan Sertifikasi', 'desc' => 'Melalui Lembaga Pelatihan Kerja (LPKH) kami yang berlisensi, kami menyediakan pelatihan berbasis kompetensi dalam keterampilan kerja, penguasaan bahasa dasar, adaptasi budaya, dan literasi keuangan. Program ini dirancang untuk meningkatkan kapasitas pekerja dan memastikan kesesuaian dengan standar internasional.'],
                    ['icon' => 'people', 'title' => 'Konsultasi dan Pengembangan Kemitraan', 'desc' => 'Kami memberikan layanan konsultasi strategis kepada pemangku kepentingan pemerintah, mitra internasional, dan lembaga ketenagakerjaan. Fokus kami mencakup kebijakan ketenagakerjaan, penempatan lintas negara, serta praktik rekrutmen berkelanjutan yang mengutamakan transparansi, etika, dan dampak jangka panjang.'],
                ];
            @endphp

            @foreach($services as $service)
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-2 text-sky-900">
                            <i class="bi bi-{{ $service['icon'] }} me-2"></i>
                            {{ $service['title'] }}
                        </h5>
                        <p class="text-muted mb-0">{{ $service['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <section class="py-5 bg-sky-900">
        <div class="container">
            <h2 class="fw-bold text-center mb-5 text-white">Kenali Kami Lebih Dekat</h2>
            <div class="ratio ratio-16x9 rounded-5 shadow-sm">
                <iframe 
                    src="https://www.youtube.com/embed/ARYAPTetEOE?rel=0&autoplay=0&showinfo=0" 
                    title="YouTube video"
                    allowfullscreen
                    class="rounded"
                ></iframe>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <h2 class="fw-bold text-center mb-5 text-sky-900">Alur Proses Penempatan</h2>
        <div class="row g-4 justify-content-center text-white">
            @php
                $steps = [
                    ['icon' => 'globe2', 'title' => 'Online', 'desc' => 'CPMI mengisi data pribadi melalui website. PT Bahana akan meninjau seluruh informasi, dan jika sesuai, kandidat akan diundang untuk wawancara daring.'],
                    ['icon' => 'geo-alt', 'title' => 'Offline', 'desc' => 'CPMI mengunjungi kantor cabang untuk proses seleksi dan dokumentasi pribadi secara langsung.'],
                    ['icon' => 'easel', 'title' => 'Sesi Pelatihan', 'desc' => 'Pekerja yang terpilih mengikuti pelatihan bahasa, orientasi budaya, dan keterampilan kerja selama kurang lebih dua bulan.'],
                    ['icon' => 'file-earmark-text', 'title' => 'Proses Dokumen', 'desc' => 'Pekerja menyelesaikan seluruh dokumen resmi yang dibutuhkan untuk bekerja di luar negeri.'],
                    ['icon' => 'airplane', 'title' => 'Penerbangan', 'desc' => 'Pekerja diberangkatkan ke negara tujuan penempatan sesuai dengan jadwal yang telah ditentukan.'],
                ];
            @endphp

            @foreach($steps as $step)
                <div class="col-lg-4">
                    <div class="card h-100 bg-sky-900 border-0 shadow text-white text-center p-4">
                        <i class="bi bi-{{ $step['icon'] }} fs-1 mb-3 text-white"></i>
                        <h6 class="fw-bold text-white">{{ $step['title'] }}</h6>
                        <p class="mb-0">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="py-5 text-center bg-light">
        <section class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold text-sky-900 mb-3">Bersiap Menjadi Bagian dari Perjalanan Global Bersama <span class="text-sky-500">BAHANA Mega Prestasi</span>?</h2>
                    <p class="lead text-muted mb-2">
                        Ayo wujudkan cita-cita menembus pasar internasional! Kami hadir sebagai mitra strategis dalam penyaluran tenaga kerja yang <strong>aman</strong>, <strong>cepat</strong>, dan <strong>berintegritas</strong>.
                    </p>
                    <p class="text-muted mb-4">
                        Bersama tim ahli kami, perluas jaringan bisnis Anda ke dunia dengan pendekatan yang profesional dan berdampak jangka panjang.
                    </p>
                    <a href="{{ route('home.contact') }}" class="btn btn-sky-900 rounded-pill mb-2 px-4 py-2">
                        <i class="bi bi-people-fill me-2"></i>Hubungi Tim Kami Sekarang
                    </a>
                    <a href="{{ route('auth.registrasi') }}" class="btn btn-sky-500 rounded-pill mb-2 px-4 py-2 ms-2">
                        <i class="bi bi-person-plus-fill me-2"></i>Registrasi Sekarang
                    </a>
                </div>
            </div>
        </section>
    </section>

@endsection
