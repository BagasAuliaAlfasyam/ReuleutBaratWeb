@extends('template.blog')
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-8 entries">
                        @if (Request::is('blog'))
                            @if ($blog->isEmpty())
                                <section
                                    class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                                    <h1>404</h1>
                                    <h2>Berita Kosong.</h2>
                                    <a class="btn" href="{{ url()->previous() }}">Back</a>
                                </section>
                            @endif
                            @include('pages.blog.posts')
                        @else
                            @include('pages.blog.post')
                        @endif

                        @if (Request::is('blog'))
                            {{ $blog->links() }}
                        @endif
                    </div>
                    <!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <h3 class="sidebar-title">Cari</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ url('/blog') }}">
                                    @if (request('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif
                                    @if (request('author'))
                                        <input type="hidden" name="author" value="{{ request('author') }}">
                                    @endif
                                    @if (request('published'))
                                        <input type="hidden" name="published" value="{{ request('published') }}">
                                    @endif
                                    @if (request('tag'))
                                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                                    @endif
                                    <input type="text" name="search" value="{{ old('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Kategori</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($categories as $item)
                                        <a href="{{ url('/blog?category=') . $item->slug }}">
                                            <span class="text-muted">{{ $item->name }}</span>
                                        </a>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Berita Terbaru</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recent as $recen)
                                    <div class="post-item clearfix">
                                        <img src="{{ url('/storage/uploads/images') . '/' . $recen->images }}"
                                            alt="{{ $recen->images }}">
                                        <h4><a
                                                href="{{ url('/blog/detail') . '/' . $recen->slug_post }}">{!! $recen->title_post !!}</a>
                                        </h4>
                                        <time
                                            datetime="{{ $recen->created_at->toDateTimeString() }}">{{ $recen->created_at->diffForHumans() }}</time>
                                    </div>
                                @endforeach
                            </div><!-- End sidebar recent posts-->

                            <h3 class="sidebar-title">Tag</h3>
                            <div class="sidebar-item tags">
                                <ul>
                                    @foreach ($tags as $item)
                                        <li><a
                                                href="{{ url('/blog?tag=') . $item->slug_tag }}">{{ $item->name_tag }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar tags-->

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
@push('script')
    <style>
        .error-404 {
            padding: 30px;
        }

        .error-404 h1 {
            font-size: 180px;
            font-weight: 700;
            color: #4154f1;
            margin-bottom: 0;
            line-height: 150px;
        }

        .error-404 h2 {
            font-size: 24px;
            font-weight: 700;
            color: #012970;
            margin-bottom: 30px;
        }

        .error-404 .btn {
            background: #51678f;
            color: #fff;
            padding: 8px 30px;
        }

        .error-404 .btn:hover {
            background: #3e4f6f;
        }

        @media (min-width: 992px) {
            .error-404 img {
                max-width: 50%;
            }
        }
    </style>
@endpush
