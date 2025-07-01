<nav class="navbar navbar-light bg-white border-top fixed-bottom shadow-sm d-lg-none">
    <div class="container justify-content-around">
        <a href="{{ route('cpmi.home') }}" class="nav-link text-center {{ request()->routeIs('cpmi.home') ? 'text-sky-900 fw-semibold' : 'text-muted' }}">
            <i class="bi bi-house-door-fill" style="font-size: 18px"></i><br>
            <small style="font-size: 10px">Beranda</small>
        </a>
        <a href="{{ route('cpmi.kelas') }}" class="nav-link text-center {{ request()->routeIs('cpmi.kelas') ? 'text-sky-900 fw-semibold' : 'text-muted' }}">
            <i class="bi bi-easel2-fill" style="font-size: 18px"></i><br>
            <small style="font-size: 10px">Kelas</small>
        </a>
        <a href="{{ route('cpmi.absensi') }}" class="nav-link text-center {{ request()->routeIs('cpmi.absensi') ? 'text-sky-900 fw-semibold' : 'text-muted' }}">
            <i class="bi bi-check-square-fill" style="font-size: 18px"></i><br>
            <small style="font-size: 10px">Absensi</small>
        </a>
        <a href="{{ route('cpmi.lowonganKerja') }}" class="nav-link text-center {{ request()->is('cpmi/lowongan-kerja*') ? 'text-sky-900 fw-semibold' : 'text-muted' }}">
            <i class="bi bi-briefcase-fill" style="font-size: 18px"></i><br>
            <small style="font-size: 10px">Kerja</small>
        </a>
        <a href="{{ route('cpmi.profile') }}" class="nav-link text-center {{ request()->routeIs('cpmi.profile') ? 'text-sky-900 fw-semibold' : 'text-muted' }}">
            <i class="bi bi-person-fill" style="font-size: 18px"></i><br>
            <small style="font-size: 10px">Profil</small>
        </a>
    </div>
</nav>