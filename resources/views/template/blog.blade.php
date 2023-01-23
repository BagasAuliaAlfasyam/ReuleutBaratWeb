<!DOCTYPE html>
<html lang="en">
@include('template.header')

<body>
  @include('template.navbar')

  @if (!Request::is('blog') && request()->path() == '/' && !Request::is('team'))
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Desa Reuleut Barat</h1>
            <h2 data-aos="fade-up" data-aos-delay="400">Prioritas Informasi Anda Adalah Milik Kami</h2>
            <div data-aos="fade-up" data-aos-delay="600">
              <div class="text-center text-lg-start">
                <div class="container_mouse">
                  <span class="mouse-btn">
                      <span class="mouse-scroll"></span>
                  </span>
                </div>

                <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Tentang Kami</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/relet.webp" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </section><!-- End Hero -->
  @endif

  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  @include('template.footer')
  @include('template.script')
</body>

</html>
