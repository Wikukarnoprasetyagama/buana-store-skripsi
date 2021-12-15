<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Admin Buana Store</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">ABS</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item">
                <a href="{{ route('dashboard-admin') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Menu</li>
              <li class="nav-item">
                <a href="{{ route('sliders.index') }}" class="nav-link"><i class="fas fa-photo-video"></i> <span>Slide</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products-admin.index') }}" class="nav-link"><i class="fas fa-store"></i> <span>Produk</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link"><i class="fas fa-list"></i> <span>Kategori</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('upload.create') }}" class="nav-link"><i class="fas fa-cart-plus"></i> <span>Keranjang</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('verification.index') }}" class="nav-link"><i class="fas fa-user-check"></i> <span>Permintaan Verifikasi</span></a>
              </li>
              <li class="menu-header">Data Members</li>
              <li class="nav-item">
                <a href="{{ route('seller.index') }}" class="nav-link"><i class="fas fa-store"></i> <span>Seller</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-users"></i> <span>Customer</span></a>
              </li>
              <li class="menu-header">Data Transaksi</li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-store"></i> <span>Seller</span></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-users"></i> <span>Customer</span></a>
              </li>
              <div class="mt-3 mb-4 p-3 hide-sidebar-mini">
                <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
              </div>
            </ul>
        </aside>
      </div>






{{-- <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ url('/admin') }}"
                        ><i class="menu-icon fa fa-laptop"></i>Dashboard
                    </a>
                </li>
                <li class="menu-title">Menu</li>
                <!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('sliders.index') }}">
                        <i class="menu-icon fa fa-list"></i>Daftar Slider</a
                    >
                </li>

                <li class="menu-title">Data Member</li>
                <!-- /.menu-title -->
                <li class="">
                    <a href="#">
                        <i class="menu-icon fas fa-store"></i>
                        Seller</a
                    >
                </li>
                <li class="">
                    <a href="#">
                        <i class="menu-icon fa fa-users"></i>User</a
                    >
                </li>

                <li class="menu-title">Data Transaksi</li>
                <!-- /.menu-title -->
                <li class="">
                    <a href="#">
                        <i class="menu-icon fas fa-money-check"></i>
                        Transaksi Seller</a
                    >
                </li>
                <li class="">
                    <a href="#">
                        <i class="menu-icon fas fa-money-check"></i>
                        Transaksi User</a
                    >
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</aside> --}}
