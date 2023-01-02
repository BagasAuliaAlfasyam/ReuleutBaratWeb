<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Desa Reuleut Barat | MASUK</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('/assets/img/logo_kom.png') }}" rel="icon">
    <link href="{{ url('/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('/assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url('/assets/admin/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ url('/assets/img/logo_kom.png') }}" alt="logo_kom.png">
                                    <span class="d-none d-lg-block">Desa Reuleut Barat</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Masuk Ke Akun Anda</h5>
                                        <p class="text-center small">Masukan email & Kata Sandi Anda Untuk Masuk</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ url('/login') }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="youremail" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" class="form-control" id="youremail" required>
                                                <div class="invalid-feedback">Harap Masukan Email Anda.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Harap Masukan Kata Sandi Anda!</div>
                                        </div>

                                        <div class="col-12">
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Masuk</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="{{ url('/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (Session::has('message'))
            Swal.fire({
                icon: 'success',
                title: 'Succes',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1000
            })
        @endif

        @if (Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1000
            })
        @endif

        @if (Session::has('info'))
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 1000
            })
        @endif

        @if (Session::has('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 1000
            })
        @endif
    </script>
</body>

</html>
