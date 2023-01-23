@extends('template.blog')

@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content shadow">
                        <h3>Tentang</h3>
                        <h2>Sejarah Desa Reuleut Barat.</h2>
                        <p>
                            Desa Reuleut Barat awalnya adalah suatu program desa Binaan yang dicetuskan oleh pemerintah dan perusahaan yaitu PT. Pupuk Iskandar Muda dalam rangka pemekaran wilayah pada desa di Kecamatan Muara Batu, Kabupaten Aceh Utara.
Pada awal pendiriannya penduduk hanya terpusat pada Desa Reuleut berkisaran pada tahun 2010 an. Setelah beberapa waktu Desa Reuleut di bagi menjadi 2 yaitu Reuleut Barat dan Reuleut Timu.

                        </p>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets/img/reuleutbaratt.webp" class="img-fluid img-thumbnail" alt="Meunasah Reuleut Barat">
                </div>

            </div>
        </div>

    </section><!-- End About Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="portfolio">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>GALERI</h2>
                <p>DESA REULEUT BARAT</p>
            </header>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">Semua</li>
                        @foreach ($filter as $item)
                            <li data-filter="{{ '.' . $item }}">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                @foreach ($gallery as $item)
                    <div class="col-lg-4 col-md-6 portfolio-item {{ $item->filter_gallery }}">
                        <div class="portfolio-wrap">
                            <img src="/storage/uploads/images/{{ $item->images }}" class="img-fluid"
                                alt="{{ $item->images }}">
                            <div class="portfolio-info">
                                <div class="portfolio-links">
                                    <a href="{{ url('/storage/uploads/images') . '/' . $item->images }}"
                                        data-gallery="portfolioGallery" class="portfokio-lightbox"
                                        title="{!! $item->description !!}"><i class="bi bi-search"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </section><!-- End Gallery Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>Berita</h2>
                <p>Berikut Adalah Berita Terbaru</p>
            </header>

            <div class="row">

                @foreach ($recent as $item)
                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img">
                                <img src="/storage/uploads/images/{{ $item->images }}" class="img-fluid"
                                    alt="{{ $item->images }}">
                            </div>
                            <span class="post-date">{{ $item->created_at->diffForHumans() }}</span>
                            <h3 class="post-title">{{ $item->title_post }}</h3>
                            <a href="{{ url('/blog/detail') . '/' . $item->slug_post }}" class="readmore stretched-link mt-auto">
                                <span>Baca Selengkapnya</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </section><!-- End Recent Blog Posts Section -->
@endsection
