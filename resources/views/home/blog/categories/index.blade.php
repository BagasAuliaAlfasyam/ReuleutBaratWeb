@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Berita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Berita</li>
                    <li class="breadcrumb-item active"><a href="{{ url('/blog/categories') }}">Kategori</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Kategori Berita</h5>
                            <a href="{{ url('/blog/category/create') }}" role="button" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Kategori
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless datatable text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-center" scope="col">Slug</th>
                                            <th class="text-center" scope="col">Nama</th>
                                            <th class="text-center" scope="col">kunjungan</th>
                                            <th class="text-center" scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td><span
                                                        class="badge {{ $item->post->count() < 20 ? 'bg-danger' : ($item->post->count() <= 80 ? 'bg-warning' : 'bg-success') }}">{{ $item->post->count() }}</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group"
                                                        aria-label="Basic example">
                                                        <form action="{{ url('/blog/category/edit') . '/' . $item->id }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-warning">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ url('/blog/category/destroy') . '/' . $item->id }}"
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
