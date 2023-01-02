<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img src="{{ url('/assets/img/R.jpg') }}" alt="R.jpg">
            <span>REULEUT BARAT</span>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{ Request::is('/#hero') ? 'active' : '' }}" href="{{ url('/#hero') }}">Beranda</a></li>
                <li><a class="nav-link scrollto {{ Request::is('/#about') ? 'active' : '' }}" href="{{ url('/#about') }}">Tentang</a></li>
                {{-- <li><a class="nav-link scrollto" href="#services">Mission</a></li> --}}
                <li><a class="nav-link scrollto {{ Request::is('/#gallery') ? 'active' : '' }}" href="{{ url('/#gallery') }}">Galeri</a></li>
                <li><a class="nav-link scrollto {{ Request::is('/team') ? 'active' : '' }}" href="{{ url('/team') }}">Pemerintah Desa</a></li>
                <li><a class="nav-link scrollto {{ Request::is('/blog') ? 'active' : '' }}" href="{{ url('/blog') }}">Berita</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
