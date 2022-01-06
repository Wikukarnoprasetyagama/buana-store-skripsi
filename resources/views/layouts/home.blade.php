<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ url('/images/test-pavicon.svg') }}">
    @include('includes.style')
    <title>Buana Store - Web Toko Online Kec: Tapung Hilir Kab: Kampar</title>
  </head>
  <body>
    @include('includes.navbar')

    @yield('content')

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-warning"></i> Peringatan!</h5>
        <button type="button" class="btn-close hidden" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        Apakah anda yakin ingin keluar ?
      </div>
      <div class="modal-footer">
        <form action="{{ url('logout') }}" method="POST">
            @csrf
            <button class="btn btn-get-now" type="submit">Keluar Sekarang</button>
        </form>
      </div>
    </div>
  </div>
</div>

    @include('includes.footer')
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
  </body>
</html>
