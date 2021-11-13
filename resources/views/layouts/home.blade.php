<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('includes.style')
    <title>Buana Store - Web Toko Online Kec: Tapung Hilir Kab: Kampar</title>
  </head>
  <body>
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')
    @include('includes.script')
  </body>
</html>
