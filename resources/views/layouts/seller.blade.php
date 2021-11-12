<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>

 @stack('before-style')
 @include('includes.seller.style')
 @stack('after-style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
            @include('includes.seller.navbar')
            @include('includes.seller.sidebar')
            @yield('content')
            @include('includes.seller.footer')
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin keluar ?</div>
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
  </div>
  @stack('before-script')
  @include('includes.seller.script')
  @stack('after-script')
</body>
</html>
