@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="/storage/uploads/images/{{ auth()->user()->user_images }}"
                                alt="{{ $data->user_images }}" class="rounded-circle">
                            <h2>{{ $data->fullname }}</h2>
                            <h3>
                                @if ($data->role == true)
                                    Admin
                                @else
                                    Aparatur Desa
                                @endif
                            </h3>
                            <div class="social-links mt-2">
                                <a href="https://twitter.com/" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="https://facebook.com/" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="https://instagram.com" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="https://linkedin.com/" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true"
                                        role="tab">Akun</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab"
                                        tabindex="-1">Ubah Profil</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false"
                                        tabindex="-1" role="tab">Ubah Kata Sandi</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-image" aria-selected="false"
                                        tabindex="-1" role="tab">Ubah foto profil</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                                    <h5 class="card-title">Detail profil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $data->fullname }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Role</div>
                                        <div class="col-lg-9 col-md-8">
                                            @if ($data->role == true)
                                                Admin
                                            @else
                                                Aparatur Desa
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                                        <div class="col-lg-9 col-md-8">{{ $data->address }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nomor HP</div>
                                        <div class="col-lg-9 col-md-8"> {{ $data->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $data->email }}</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                                    <!-- Profile Edit Form -->
                                    <form action="{{ url('/profile/update') . '/' . $data->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="old_picture" value="{{ auth()->user()->user_images }}">
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="/storage/uploads/images/{{ auth()->user()->user_images }}" alt="Profile">
                                                {{-- <div class="pt-2">
                                                    <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i
                                                            class="bi bi-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                                                            class="bi bi-trash"></i></a>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullname" type="text"
                                                    class="form-control @error('fullname')
                                                    is-invalid
                                                @enderror"
                                                    id="fullName" value="{{ $data->fullname }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="{{ $data->email }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">No HP</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone"
                                                    value="{{ $data->phone }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address"
                                                    value="{{ $data->address }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                    <!-- Change Password Form -->
                                    <form action="{{ url('/password/update') . '/' . $data->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Saat Ini</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password"
                                                    class="form-control @error('current_password')
                                                    is-invalid
                                                @enderror"
                                                    id="currentPassword">
                                                @error('current_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password"
                                                    class="form-control @error('password')
                                                    is-invalid
                                                @enderror"
                                                    id="newPassword">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Ketik Ulang Kata Sandi</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password"
                                                    class="form-control @error('password')
                                                    is-invalid
                                                @enderror"
                                                    id="renewPassword">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-image" role="tabpanel">
                                    <!-- Change Password Form -->
                                    <form action="{{ url('/image/update') . '/' . $data->id }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <div class="row mb-3">
                                            <label for="role" class="col-md-4 col-lg-3 col-form-label">Ganti foto profil</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="file" class="form-control @error('images') is-invalid @enderror" id="images"
                                                    name="user_images" onchange="previewImg()">
                                                @error('images')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            
                                            <div class="col-md-5 mx-auto mt-4">
                                                <img src="/storage/uploads/images/{{ auth()->user()->user_images }}" alt="" class="img-thumbnail img-preview">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                                        </div>
                                    </form><!-- End Change Password Form -->
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @section('image-javascript')
        <script>
            const imgPreview = document.querySelector('.img-preview'),
                imgInput = document.querySelector('#images')

            function previewImg() {
                const filePicture = new FileReader()
                filePicture.readAsDataURL(imgInput.files[0])
                filePicture.onload = e => {
                    imgPreview.src = e.target.result
                }
            }
        </script>
    @endsection
@endsection
