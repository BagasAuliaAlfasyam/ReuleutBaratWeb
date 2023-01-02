@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Berita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Berita</li>
                    <li class="breadcrumb-item"><a href="{{ url('/blog/categories') }}">Kategori</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('/blog/category/create') }}">Tambah</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Kategori</h5>
                            <a href="{{ url('/blog/categories') }}" role="button" class="btn btn-secondary mb-2">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                            {{-- Form --}}
                            <!-- Custom Styled Validation -->
                            <form class="row g-3 needs-validation {{ $errors->any() ? 'was-validated' : '' }}" action="{{ url('/blog/category') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control @error('name')
                                        is-invalid
                                    @enderror" id="name" name="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{  $message  }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug Kategori</label>
                                    <input type="text" class="form-control @error('slug')
                                        is-invalid
                                    @enderror" id="slug" name="slug"
                                        value="{{ old('slug') }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Kirim</button>
                                </div>
                            </form><!-- End Custom Styled Validation -->
                            {{-- End Form --}}
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
@push('script')
    <script>
        document.getElementById('name').onkeyup = function(){
            let name = document.getElementById('name');
            let slug = document.getElementById('slug');
            slug.value = name.value.toLowerCase().replaceAll(' ', '-');
        }
    </script>
@endpush