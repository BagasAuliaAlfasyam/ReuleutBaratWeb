@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Berita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Berita</li>
                    <li class="breadcrumb-item active"><a href="{{ url('/blog/posts') }}">Postingan Berita</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Postingan Berita</h5>
                            <a href="{{ url('/blog/post/create') }}" role="button" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Postingan
                            </a>
                        </div>
                        <div class="card-body mt-2">
                            <div class="table-responsive">
                                <table class="table table-borderless datatable text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-center" scope="col">Kategori</th>
                                            <th class="text-center" scope="col">Judul</th>
                                            <th class="text-center" scope="col">Dilihat</th>
                                            <th class="text-center" scope="col">Status</th>
                                            <th class="text-center" scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->title_post }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $item->visit < 20 ? 'bg-danger' : ($item->visit <= 80 ? 'bg-warning' : 'bg-success') }}">{{ $item->visit ?? 0 }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $item->publish_status == true ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $item->publish_status == true ? 'Published' : 'Darft' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group"
                                                        aria-label="Basic example">
                                                        <form action="{{ url('/blog/post/show') . '/' . $item->id }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ url('/blog/post/edit') . '/' . $item->id }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-warning">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ url('/blog/post/destroy') . '/' . $item->id }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="alert('Yakin untuk menghapus data ini?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
