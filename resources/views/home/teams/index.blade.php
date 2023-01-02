@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Struktur Aparatur Desa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                    <li class="breadcrumb-item">Struktur & Galeri</li>
                    <li class="breadcrumb-item active"><a href="{{ url('/teams') }}">Struktur Aparatur Desa</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">
                    {{-- Card --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">STRUKTUR APARATUR DESA</h5>
                            <p>DESA REULEUT BARAT PERIODE {{ date('Y') }} - {{ date('Y') + 1 }}</p>
                            <a href="{{ url('/team/create') }}" role="button" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Struktur
                            </a>
                        </div>
                    </div>
                    {{-- End card --}}
                    <section id="team" class="team">
                        <div class="container aos-init aos-animate" data-aos="fade-up">
                            <div class="row gy-4">

                                @foreach ($data as $item)
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate"
                                        data-aos="fade-up" data-aos-delay="100">
                                        <div class="member">
                                            <div class="member-img">
                                                <img src="/storage/uploads/images/{{ $item->images }}"
                                                    class="img-fluid" alt="{{ $item->images }}">
                                                <div class="social">
                                                    <a href="https://whatsapp.com/"><i class="bi bi-whatsapp"></i></a>
                                                    <a href="https://facebook.com/"><i class="bi bi-facebook"></i></a>
                                                    <a href="https://instagram.com/"><i class="bi bi-instagram"></i></a>
                                                    <a href="{{ url('/team/destroy') . '/' . $item->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="member-info">
                                                <h4><a
                                                        href="{{ url('/team/edit') . '/' . $item->id }}">{{ $item->fullname }}</a>
                                                </h4>
                                                <span>{{ $item->jabatan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>

    </main>
@endsection
@push('script')
    <style>
        .team {
            /* background: #fff; */
            padding: 60px 0;
        }

        .team .member {
            overflow: hidden;
            text-align: center;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08);
            transition: 0.3s;
        }

        .team .member .member-img {
            position: relative;
            overflow: hidden;
        }

        .team .member .member-img:after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            background: url(../img/team-shape.svg) no-repeat center bottom;
            background-size: contain;
            z-index: 1;
        }

        .team .member .social {
            position: absolute;
            right: -100%;
            top: 30px;
            opacity: 0;
            border-radius: 4px;
            transition: 0.5s;
            background: rgba(255, 255, 255, 0.3);
            z-index: 2;
        }

        .team .member .social a {
            transition: color 0.3s;
            color: rgba(1, 41, 112, 0.5);
            margin: 15px 12px;
            display: block;
            line-height: 0;
            text-align: center;
        }

        .team .member .social a:hover {
            color: rgba(1, 41, 112, 0.8);
        }

        .team .member .social i {
            font-size: 18px;
        }

        .team .member .member-info {
            padding: 10px 15px 20px 15px;
        }

        .team .member .member-info h4 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 20px;
            color: #012970;
        }

        .team .member .member-info span {
            display: block;
            font-size: 14px;
            font-weight: 400;
            color: #aaaaaa;
        }

        .team .member .member-info p {
            font-style: italic;
            font-size: 14px;
            padding-top: 15px;
            line-height: 26px;
            color: #5e5e5e;
        }

        .team .member:hover {
            transform: scale(1.08);
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
        }

        .team .member:hover .social {
            right: 8px;
            opacity: 1;
        }
    </style>
@endpush
