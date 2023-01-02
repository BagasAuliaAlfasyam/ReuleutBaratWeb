@extends('home.template.main')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dasbor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                    <li class="breadcrumb-item active">Dasbor</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                                        <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                                        <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Semua Berita</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['post'] }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Kategori</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-card-list"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['category'] }}</h6>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Kunjungan</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['visitor'] }}</h6>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Postingan Terbaru</h5>
                                    <small>
                                        @if ($data['latest_post'] != null)
                                            <img src="{{ url('/storage/uploads/images') . '/' . $data['latest_post']->images }}"
                                                alt="{{ $data['latest_post']->images }}"
                                                class="img-fluid rounded float-start" style="margin-right: 1%">
                                            <p>
                                                <strong>{{ $data['latest_post']->title_post }}</strong> <br>
                                                <span>Author: {{ $data['latest_post']->author->fullname }}</span>
                                            </p>
                                        @endif
                                    </small>
                                    <canvas id="lineChart"
                                        style="max-height: 400px; display: block; box-sizing: border-box; height: 221px; width: 443px;"
                                        width="443" height="221"></canvas>

                                </div>

                            </div>
                        </div><!-- End Top Selling -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                                <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                                <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Website Traffic <span>| Hari Ini</span></h5>
                            <small class="text-muted">Posting diterbitkan berdasarkan kategori</small>
                            <canvas id="pieChart" class="mt-4"
                                style="max-height: 400px; display: block; box-sizing: border-box; height: 400px; width: 443px;"
                                width="443" height="400"></canvas>
                        </div>
                    </div><!-- End Website Traffic -->
                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
@push('content')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetch('{{ url('/dashboard/traffic') }}', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                },
            }).then(function(res) {
                return res.json();
            }).then(function(res) {
                const dataChart = [];
                const labelChart = [];
                const color = [];
                res.postTrue.forEach((element, index) => {
                    return dataChart.push(element.dataTrue)
                });
                res.postTrue.forEach((element, index) => {
                    return labelChart.push(element.labelTrue)
                });
                res.color.forEach((element, index) => {
                    element.forEach((el) => {
                        return color.push(el)
                    })
                })
                new Chart(document.querySelector('#pieChart'), {
                    type: 'pie',
                    data: {
                        labels: labelChart,
                        datasets: [{
                            label: 'My First Dataset',
                            data: dataChart,
                            backgroundColor: color,
                            hoverOffset: 4
                        }]
                    }
                });
            });
        });
        document.addEventListener("DOMContentLoaded", () => {
            fetch('{{ url('/dashboard/post') }}', {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                },
            }).then(function(res) {
                return res.json();
            }).then(function(res) {
                const dataChart = [];
                const labelChart = [];
                res.pub.forEach((element, index) => {
                    return dataChart.push(element.data)
                });
                res.pub.forEach((element, index) => {
                    return labelChart.push(element.label)
                });
                const dataDraft = [];
                const labelDraft = [];
                res.draft.forEach((element, index) => {
                    return dataDraft.push(element.data)
                });
                res.draft.forEach((element, index) => {
                    return labelDraft.push(element.label)
                });
                new Chart(document.querySelector('#lineChart'), {
                    type: 'line',
                    data: {
                        labels: labelChart,
                        datasets: [{
                            label: 'Postingan ',
                            data: dataChart,
                            fill: false,
                            borderColor: 'rgb(54,162,235)',
                            tension: 0.1
                        }, {
                            label: 'Draft Postingan',
                            data: dataDraft,
                            fill: false,
                            borderColor: 'rgb(255,99,132)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
