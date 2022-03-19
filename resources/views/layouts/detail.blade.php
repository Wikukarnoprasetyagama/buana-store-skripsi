<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
  </head>
  <body>
    @include('includes.navbar')

    @yield('content')

    <!-- Modal Exit -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah anda yakin ingin keluar?
          </div>
          <div class="modal-footer">
            <form action="{{ url('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="submit">Keluar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Keterangan Aplikasi -->
    <div class="modal fade" id="tentangAplikasi" tabindex="-1" aria-labelledby="tentangAplikasiLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tentangAplikasiLabel">Keterangan Tentang Aplikasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            Ini adalah sebuah project Aplikasi Skripsi yang saya buat, <br> dari Program Studi Teknik Informatika Universitas Islam Riau.
            dengan judul <br> <strong>"Aplikasi Jual Beli Online Berbasis Web Menggunakan Midtrans Sebagai Verifikasi Pembayaran (Studi Kasus: Kecamatan Tapung Hilir, Kampar)"</strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
