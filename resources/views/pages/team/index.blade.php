@extends('template.blog')
@section('content')
    <!-- ======= Team Section ======= -->
    <section id="team" class="team mt-5">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>STRUKTUR PEMERINTAH</h2>
                <p>DESA REULEUT BARAT PERIODE 2022 - 2023</p>
            </header>

            <div class="row gy-4">

                @foreach ($data as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <div class="member-img">
                            <img src="{{ url('/storage/uploads/images') . '/' . $item->images }} " class="img-fluid" alt="{{ $item->images }}">
                            <div class="social">
                                <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                                <a href="https://www.linkedin.com/"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>{{ $item->fullname }}</h4>
                            <span><strong>{{ $item->jabatan }}</strong></span>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>

        </div>

    </section><!-- End Team Section -->
@endsection
