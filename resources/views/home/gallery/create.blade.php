@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Galeri</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Struktur & Galeri</li>
                    <li class="breadcrumb-item"><a href="{{ url('/blog/galleries') }}">Galeri</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('/blog/gallery/create') }}">Buat</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Insert Gallery</h5>
                            <a href="{{ url('/galleries') }}" role="button" class="btn btn-secondary mb-2">
                                <i class="bi bi-arrow-left-circle"></i> Back
                            </a>
                            {{-- Form --}}
                            <!-- Custom Styled Validation -->
                            <form class="row g-3 needs-validation {{ $errors->any() ? 'was-validated' : '' }}"
                                action="{{ url('/gallery') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="filter_gallery" class="form-label">Filters</label>
                                    <select class="form-control" name="filter_gallery" id="filter_gallery">
                                        <option>Select your filter</option>
                                        @foreach ($filter as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('filter_gallery')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="images" class="form-label">Images</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror"
                                        id="images" name="images" value="{{ old('images') }}" required>
                                    @error('images')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Write a description here" id="description" name="description" style="height: 100px"></textarea>
                                        <label for="description">Description</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
