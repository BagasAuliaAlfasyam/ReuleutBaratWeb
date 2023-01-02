@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Berita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Berita</li>
                    <li class="breadcrumb-item"><a href="{{ url('/blog/posts') }}">Postingan Berita</a></li>
                    <li class="breadcrumb-item active">Detail Berita</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Detail Berita</h5>
                            <a href="{{ url('/blog/posts') }}" role="button" class="btn btn-secondary mb-2">
                                <i class="bi bi-arrow-left-circle"></i> kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <img src="{{ url('/storage/uploads/images') . '/' . $data->images }}" alt="{{ $data->images }}"
                                class="img-thumbnail mt-2">
                            <h1><strong>{!! $data->title_post !!}</strong></h1>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i
                                            class="bi bi-person"></i>{{ $data->author->fullname }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                        <time datetime="2020-01-01">{{ $data->created_at->diffForHumans() }}</time>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-card-list"></i>
                                        {{ $data->category->name }}
                                    </li>
                                    @if (!$data->post_tag->isEmpty())
                                        @foreach ($data->post_tag as $item)
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-tags"></i>
                                                {{ $item->tag->name_tag }}</>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <div class="">
                                {!! $data->body_post !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection

@push('script')
    <style>
        .card .card-body .entry-meta {
            margin-bottom: 15px;
            color: #4084fd;
        }

        .card .card-body .entry-meta ul {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            align-items: center;
            padding: 0;
            margin: 0;
        }

        .card .card-body .entry-meta ul li+li {
            padding-left: 20px;
        }

        .card .card-body .entry-meta i {
            font-size: 16px;
            margin-right: 8px;
            line-height: 0;
        }

        .blog .entry .entry-meta a {
            color: #777777;
            font-size: 14px;
            display: inline-block;
            line-height: 1;
        }
    </style>
@endpush
