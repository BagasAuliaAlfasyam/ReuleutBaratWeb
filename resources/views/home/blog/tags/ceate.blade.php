@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Berita</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Berita</li>
                    <li class="breadcrumb-item"><a href="{{ url('/blog/tags') }}">Tag</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('/blog/tag/create') }}">Buat</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buat Tag</h5>
                            <a href="{{ url('/blog/tags') }}" role="button" class="btn btn-secondary mb-2">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                            {{-- Form --}}
                            <!-- Custom Styled Validation -->
                            <form class="row g-3 needs-validation {{ $errors->any() ? 'was-validated' : '' }}" action="{{ url('/blog/tag') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name_tag" class="form-label">Nama Tag</label>
                                    <input type="text" class="form-control @error('name_tag')
                                        is-invalid
                                    @enderror" id="name_tag" name="name_tag"
                                        value="{{ old('name_tag') }}" required>
                                    @error('name_tag')
                                        <div class="invalid-feedback">
                                            {{  $message  }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="slug_tag" class="form-label">Slug Tag</label>
                                    <input type="text" class="form-control @error('slug_tag')
                                        is-invalid
                                    @enderror" id="slug_tag" name="slug_tag"
                                        value="{{ old('slug_tag') }}" required>
                                    @error('slug_tag')
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
        document.getElementById('name_tag').onkeyup = function(){
            let name = document.getElementById('name_tag');
            let slug = document.getElementById('slug_tag');
            slug.value = name.value.toLowerCase().replaceAll(' ', '-');
        }
    </script>
@endpush