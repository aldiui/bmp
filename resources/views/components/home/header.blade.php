<nav class="navbar navbar-expand-lg bg-white fixed-top" id="topNavbarNew">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <div class="me-3">
                <img src="{{ asset('img/logo.png') }}" width="120px" alt="Attendify.id - logo">
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
                    <a class="nav-link me-lg-3 {{ request()->routeIs('home.index') ? 'active fw-semibold text-sky-900' : '' }}"  href="{{ route('home.index') }}">Beranda</a>
                </li>
                <li class="nav-item mx-auto mx-lg-0">
                    <a class="nav-link me-lg-3 {{ request()->routeIs('home.about') ? 'active fw-semibold text-sky-900' : '' }}" href="{{ route('home.about') }}">Tentang Kami</a>
                </li>
                <li class="nav-item mx-auto mx-lg-0">
                    <a class="nav-link me-lg-3 {{ request()->routeIs('home.contact') ? 'active fw-semibold text-sky-900' : '' }}" href="{{ route('home.contact') }}">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
