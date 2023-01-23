<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Main</li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="{{ url('/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dasbor</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('/') }}">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Berita</li>

        @if (Auth()->user()->role == true)
            <li class="nav-item">
                <a href="{{ url('/blog/categories') }}" class="nav-link {{ Request::is('blog/categories') ? '' : 'collapsed' }}">
                    <i class="bi bi-card-list"></i><span>Kategori</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/blog/tags') }}" class="nav-link {{ Request::is('blog/tags') ? '' : 'collapsed' }}">
                    <i class="bi bi-tags"></i><span>Tag</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ url('/blog/posts') }}" class="nav-link {{ Request::is('blog/posts') ? '' : 'collapsed' }}">
                <i class="bi bi-file-earmark-text"></i><span>Postingan Berita</span>
            </a>
        </li><!-- End Blog Posts Nav -->

        @if (Auth()->user()->role == true)
            <li class="nav-heading">Struktur & Galeri</li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('teams') ? '' : 'collapsed' }}" href="{{ url('/teams') }}">
                    <i class="bi bi-people"></i>
                    <span>Struktur Aparatur Desa</span>
                </a>
            </li><!-- End team Page Nav -->

            <li class="nav-item">
                <a class="nav-link {{ Request::is('galleries') ? '' : 'collapsed' }}" href="{{ url('/galleries') }}">
                    <i class="bi bi-card-image"></i>
                    <span>Galeri</span>
                </a>
            </li>
        @endif
        <!-- End Gallery Page Nav -->
        @if (Auth()->user()->role == true)
            <li class="nav-heading">Akun</li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account*') ? '' : 'collapsed' }}" href="{{ url('/accounts') }}">
                    <i class="bi bi-people"></i>
                    <span>Akun</span>
                </a>
            </li>
        @endif

    </ul>

</aside><!-- End Sidebar-->
