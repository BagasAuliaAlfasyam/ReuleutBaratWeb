@extends('home.template.main')
@section('content')
    <main id="main" class="main">
      <section class="pagetitle">
        <h1>Berita</h1>
        
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
            <li class="breadcrumb-item">Berita</li>
            <li class="breadcrumb-item active"><a href="{{ url('/blog/categories') }}">Tag</a></li>
          </ol>
        </nav>
      </section><!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Tag Berita</h5>
                <a href="{{ url('/blog/tag/create') }}" role="button" class="btn btn-primary">
                  <i class="bi bi-plus-circle"></i> Tag
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
                        <th class="text-center" scope="col">Kunjungan</th>
                        <th class="text-center" scope="col">Aksi</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      @foreach ($data as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->slug_tag }}</td>
                          <td>{{ $item->name_tag }}</td>
                          <td>
                            <span class="badge {{ $usage < 20 ? 'bg-danger' : ($usage <= 80 ? 'bg-warning' : 'bg-success') }}">{{ $usage }}</span>
                          </td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <form action="{{ url('/blog/tag/edit') . '/' . $item->id }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                  <i class="bi bi-pencil"></i>
                                </button>
                              </form>

                              <form action="{{ url('/blog/tag/destroy') . '/' . $item->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger"
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
