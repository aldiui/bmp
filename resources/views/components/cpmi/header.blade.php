<nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm" id="topNavbarNew">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <div class="me-3">
                <img src="{{ asset('img/logo.png') }}" width="120px" alt="BMP - logo">
            </div>
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon mid-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-auto mx-lg-0">
                    <a class="nav-link me-lg-3 {{ request()->routeIs('cpmi.home') ? 'active fw-semibold text-sky-900' : '' }}"  href="{{ route('cpmi.home') }}">Beranda</a>
                </li>
                <li class="nav-item mx-auto mx-lg-0">
                    <a class="nav-link me-lg-3 {{ request()->routeIs('cpmi.kelas') ? 'active fw-semibold text-sky-900' : '' }}"  href="{{ route('cpmi.kelas') }}">Kelas</a>
                </li>
                <li class="nav-item mx-auto mx-lg-0">
                    <a class="nav-link me-lg-3 {{ request()->routeIs('cpmi.absensi') ? 'active fw-semibold text-sky-900' : '' }}"  href="{{ route('cpmi.absensi') }}">Absensi</a>
                </li>
                <li class="nav-item mx-auto mx-lg-0">
                    <a class="nav-link {{ request()->is('cpmi/lowongan-kerja*') ? 'active fw-semibold text-sky-900' : '' }}" href="{{ route('cpmi.lowonganKerja') }}">
                        Lowongan Kerja
                    </a>
                </li>
                <li class="nav-item mx-auto mx-lg-0">
                    <a class="nav-link me-lg-3 {{ request()->routeIs('cpmi.profile') ? 'active fw-semibold text-sky-900' : '' }}"  href="{{ route('cpmi.profile') }}">
                    Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
