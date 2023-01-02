<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Vendor JS Files -->
<script src="{{ url('/assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('/assets/admin/vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ url('/assets/admin/vendor/echarts/echarts.min.js') }}"></script>
{{-- <script src="{{ url('/assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ url('/assets/admin/vendor/trix/trix.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ url('/assets/admin/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
@stack('content')