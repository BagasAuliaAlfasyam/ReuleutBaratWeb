<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ url('/dashboard') }}" class="logo d-flex align-items-center">
            <img src="{{ url('/assets/img/R.jpg') }}" alt="">
            <span class="d-none d-lg-block">REULEUT BARAT</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ Auth()->user()->user_images != 'profile-img.jpg' ? url('/storage/uploads/images/'.Auth()->user()->user_images) : url('/assets/admin/img/profile-img.jpg') }}" alt="{{ Auth()->user()->user_images }}" class="rounded-circle">
                    
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth()->user()->fullname }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth()->user()->fullname }}</h6>
                        <span>
                            @if (Auth()->user()->role == true)
                                Admin
                            @else
                                Pemerintah Desa
                            @endif
                        </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/profile') }}">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{ url('/logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center"
                                href="{{ url('/logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav>
    <!-- End Icons Navigation -->

</header><!-- End Header -->
