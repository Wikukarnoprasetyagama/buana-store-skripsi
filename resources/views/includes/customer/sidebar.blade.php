<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">{{ Auth::user()->roles }} Buana Store</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">UBS</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item">
                <a href="{{ route('dashboard-customer') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Menu</li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-cart-plus"></i> <span>Keranjang</span></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-store"></i> <span>Pesanan</span></a>
              </li>
              <li class="menu-header">Transaksi</li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-columns"></i> <span>Daftar Transaksi</span></a>
              </li>
              <li class="menu-header">Management Akun</li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-user"></i> <span>Profile</span></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
              </li>
              <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                  @if (!Auth::user()->status != 'PENDING')
                  <button class="btn btn-warning btn-lg btn-block btn-icon-split">
                        <i class="fas fa-store"></i> @foreach ($customers as $customer)
                            {{ $customer->status }}
                        @endforeach
                  </button>
                  @else
                  <a href="{{ route('open-store.create') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-store"></i> Buka Toko Sekarang
                  </a>
              @endif
            </div>
            </ul>
        </aside>
      </div>