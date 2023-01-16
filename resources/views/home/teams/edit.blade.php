@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Struktur Aparatur Desa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Struktur Dan Galeri</li>
                    <li class="breadcrumb-item"><a href="{{ url('/blog/teams') }}">Struktur Aparatur Desa</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('/blog/team/create') }}">Ubah</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ubah Struktur</h5>
                            <a href="{{ url('/teams') }}" role="button" class="btn btn-secondary mb-2">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                            {{-- Form --}}
                            <!-- Custom Styled Validation -->
                            <form class="row g-3 needs-validation {{ $errors->any() ? 'was-validated' : '' }}"
                                action="{{ url('/team/update') . '/' . $data->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-md-6">
                                    <label for="fullname" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                        id="fullname" name="fullname" value="{{ $data->fullname }}" required>
                                    @error('fullname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="images" class="form-label">Foto</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror"
                                        id="images" name="images">
                                    @error('images')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="position" class="form-label">Posisi</label>
                                        <select class="form-control" name="position" id="position">
                                            <option>Pilih Posisi</option>
                                            @foreach ($jabatan as $key => $value)
                                                <option value="{{ $value }}"
                                                    {{ $data->jabatan == $value ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('position')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Kirim</button>
                                </div>
                            </form><!-- End Custom Styled Validation -->
                            {{-- End Form --}}
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ url('/storage/uploads/images') . '/' . $data->images }}" alt="{{ $data->images }}" class="img-thumbnail my-3">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
