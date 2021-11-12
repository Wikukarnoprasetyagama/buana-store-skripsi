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

    @yield('content')

    @stack('before-script')
    @include('includes.script')
    @stack('after-script')

</body>

</html>