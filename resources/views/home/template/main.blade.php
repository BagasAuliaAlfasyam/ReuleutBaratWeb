<!DOCTYPE html>
@include('home.template.head')
<html lang="en">

<body>
    @include('home.template.navbar')
    @include('home.template.side')
    @yield('content')
    @include('home.template.footer')
    @include('home.template.script')
    @stack('script')
    @yield('image-javascript')
</body>

</html>
