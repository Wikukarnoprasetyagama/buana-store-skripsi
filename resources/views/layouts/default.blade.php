<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
    <title>@yield('title')</title>
</head>

<body>

    <!-- navbar -->
    @include('includes.navbar')
    <!-- end navbar -->


    @yield('content')


    <!-- footer -->
    @include('includes.footer')
    <!-- End footer -->






    <!-- script -->
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
    <!-- end script -->
    @include('sweetalert::alert')

    

</body>

</html>