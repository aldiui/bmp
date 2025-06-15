@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('main')
    <section class="container py-5 mt-5">
        <div class="position-relative rounded overflow-hidden shadow" style="max-width: 100%; aspect-ratio: 16/9;">
            <iframe loading="lazy"
                    style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none;"
                    src="https://www.canva.com/design/DAGlEGZIbI0/JGQG_VEM5RMh08l9OPh2RQ/view?embed"
                    allowfullscreen>
            </iframe>
        </div>
    </section>

    <section class="py-5 bg-sky-900 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <span class="badge bg-white text-sky-900 px-3 py-2 mb-2">Profil Perusahaan</span>
                        <h2 class="fw-bold">Tentang PT BAHANA MEGAPRESTASI</h2>
                        <p class="fst-italic">"Mitra terpercaya penempatan tenaga kerja Indonesia secara global."</p>
                    </div>
                    <p class="text-white text-justify">
                        PT <strong>BAHANA MEGAPRESTASI</strong> adalah perusahaan penempatan pekerja migran Indonesia (P3MI) yang didirikan pada tahun 2007. Sejak awal berdirinya, perusahaan ini telah menjembatani ribuan tenaga kerja Indonesia ke berbagai negara, terutama <strong>Taiwan</strong> dan <strong>Dominika</strong>. Fokus utama penempatan tenaga kerja di Taiwan meliputi sektor-sektor seperti pabrik, industri, perawatan lansia, pembantu rumah tangga, dan peternakan ayam. Sementara itu, Dominika menjadi tujuan baru untuk sektor konstruksi, tenaga ahli, dan operator alat berat.
                    </p>
                    <p class="text-white text-justify">
                        Dalam mendukung proses perekrutan dan pelatihan tenaga kerja, PT BAHANA MEGAPRESTASI telah mendirikan 7 kantor cabang, 3 Balai Latihan Kerja Luar Negeri (BLK–LN), beberapa Lembaga Pendidikan Kejuruan (LPK), serta menjalin kerja sama dengan BLK pemerintah. Seluruh unit ini berperan aktif dalam proses rekrutmen, seleksi, pelatihan, dan pembinaan calon pekerja dari berbagai daerah. Dengan sistem manajemen yang kuat dan proses yang tepat waktu, perusahaan mampu menghasilkan tenaga kerja yang profesional, disiplin, dan bertanggung jawab di negara penempatan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 container">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('img/visi.jpg') }}" alt="Visi" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3 text-sky-900"><i class="bi bi-eye-fill me-2"></i>Visi</h3>
                    <p>
                        Mengantarkan <strong>PT BAHANA MEGAPRESTASI</strong> menjadi salah satu perusahaan penempatan terdepan di Indonesia dan perusahaan yang dapat diandalkan baik secara Nasional maupun Internasional.
                    </p>
                </div>
            </div>

            <div class="row align-items-center flex-column-reverse flex-lg-row mb-5">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3 text-sky-900"><i class="bi bi-flag-fill me-2"></i>Misi</h3>
                    <ul class="mb-0 list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-sky-900 me-2"></i>Menjadi perusahaan penempatan dengan pekerja migran yang terampil, profesional, disiplin, dan bertanggung jawab.</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-sky-900 me-2"></i>Proses yang cepat dan terjangkau.</li>
                        <li><i class="bi bi-check-circle-fill text-sky-900 me-2"></i>Penempatan pekerjaan yang luas.</li>
                    </ul>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="{{ asset('img/misi.jpg') }}" alt="Misi" class="img-fluid rounded shadow">
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('img/tujuan.jpg') }}" alt="Tujuan Perusahaan" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-3 text-sky-900"><i class="bi bi-bullseye me-2"></i>Tujuan Perusahaan</h3>
                    <ul class="mb-0 list-unstyled">
                        <li class="mb-2"><i class="bi bi-arrow-right-circle-fill text-sky-900 me-2"></i>Melaksanakan penempatan pekerja migran Indonesia sesuai hukum Indonesia dan peraturan negara penempatan.</li>
                        <li class="mb-2"><i class="bi bi-arrow-right-circle-fill text-sky-900 me-2"></i>Mendapatkan keuntungan dari operasional tersebut.</li>
                        <li><i class="bi bi-arrow-right-circle-fill text-sky-900 me-2"></i>Mendukung program pemerintah dalam pembangunan dan kesejahteraan rakyat.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
