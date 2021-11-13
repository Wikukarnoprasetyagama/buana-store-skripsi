<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item">
                <a href="{{ url('/admin') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Menu</li>
              <li class="nav-item">
                <a href="{{ route('sliders.index') }}" class="nav-link"><i class="fas fa-list"></i> <span>Daftar Slide</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link"><i class="fas fa-list"></i> <span>Daftar Kategori</span></a>
              </li>
              <li class="menu-header">Data Members</li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-columns"></i> <span>Seller</span></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-columns"></i> <span>User</span></a>
              </li>
              <li class="menu-header">Data Transaksi</li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-columns"></i> <span>Seller</span></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-columns"></i> <span>User</span></a>
              </li>
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
