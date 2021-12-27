<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
    <title>@yield('title')</title>
  </head>
  <body>
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')
    
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
  </body>
</html>
