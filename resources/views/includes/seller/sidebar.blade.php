<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('dashboard-seller') }}">Seller Buana Store</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard-seller') }}">SBS</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item">
                <a href="{{ route('dashboard-seller') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Menu</li>
              <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Produk</span></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-columns"></i> <span>Kategori</span></a>
              </li>
              <li class="menu-header">Transaksi</li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Daftar Transaksi</span></a>
              </li>
            </ul>
        </aside>
      </div>