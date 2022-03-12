<div class="main-sidebar">
	{{-- SELLER --}}
	@if (Auth::user()->roles == 'SELLER')
		<aside id="sidebar-wrapper">
			<div class="sidebar-brand">
				<a href="{{ route('dashboard-seller') }}">{{ Auth::user()->roles }} Buana Store</a>
			</div>
			<div class="sidebar-brand sidebar-brand-sm">
				<a href="{{ route('dashboard-seller') }}">SBS</a>
			</div>
			<div class="sidebar-brand sidebar-brand-sm">
				<strong class="text-success"><i class="fas fa-user-check"></i></strong>
			</div>
			<ul class="sidebar-menu">
				<li class="text-center sidebar-brand">
					@if (Auth::user()->status == 'TERVERIFIKASI')
						<strong class="text-success">{{ Auth::user()->status }}</strong>
					@else
						<button class="btn btn-danger" data-toggle="modal" data-target="#diblokirModal"><strong class="text-white">{{ Auth::user()->status }}</strong></button>
					@endif
				</li>
				<li class="menu-header">Dashboard</li>
				<li class="nav-item">
					<a href="{{ route('dashboard-seller') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
				</li>
				<li class="menu-header">Menu</li>
				<li class="nav-item">
					<a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> <span>Beranda</span></a>
				</li>
				@if (Auth::user()->status == 'TERVERIFIKASI')
					<li class="nav-item">
						<a href="{{ route('products-seller.index') }}" class="nav-link"><i class="fas fa-list"></i> <span>Produk</span></a>
					</li>
					<li class="nav-item">
						<a href="{{ route('cart') }}" class="nav-link"><i class="fas fa-cart-plus"></i> <span>Keranjang Saya</span></a>
					</li>

					@else

					<li class="nav-item">
						<a href="{{ route('products-seller.index') }}" class="nav-link disabled"><i class="fas fa-list"></i> <span>Produk</span></a>
					</li>
					<li class="nav-item">
						<a href="{{ route('cart') }}" class="nav-link disabled"><i class="fas fa-cart-plus"></i> <span>Keranjang Saya</span></a>
					</li>
				@endif
				<li class="menu-header">Transaksi</li>
				<li class="nav-item">
					<a href="{{ route('transaction-seller.index') }}" class="nav-link"><i class="fas fa-list"></i> <span>Transaksi Penjualan</span></a>
				</li>
				<li class="nav-item">
					<a href="{{ route('my-transaction.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Transaksi Saya</span></a>
				</li>
				<li class="menu-header">Seller Management</li>
				<li class="nav-item">
					<a href="{{ route('profile-seller.index') }}" class="nav-link"><i class="fas fa-user"></i> <span>Akun Saya</span></a>
				</li>
				<div class="mt-3 mb-4 p-3 hide-sidebar-mini">
					<a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split" data-toggle="modal" data-target="#logoutModal">
					<i class="fas fa-sign-out-alt"></i> Keluar
					</a>
				</div>
			</ul>
		</aside>

		@else

		{{-- CUSTOMER --}}
		<aside id="sidebar-wrapper">
			<div class="sidebar-brand">
				<a href="index.html">{{ Auth::user()->roles }} Buana Store</a>
			</div>
			<div class="sidebar-brand sidebar-brand-sm">
				<a href="index.html">CBS</a>
			</div>
          	<ul class="sidebar-menu">
				<li class="text-center">
					@if (Auth::user()->status == 'TERVERIFIKASI')
						<strong class="text-success">{{ Auth::user()->status }}</strong>
						@elseif (Auth::user()->status != 'NONE')
						<strong class="text-warning" style="color: #FFA426">{{ Auth::user()->status }}</strong>
					@endif
				</li>
				<li class="menu-header">Dashboard</li>
				<li class="nav-item">
					<a href="{{ route('dashboard-customer') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
				</li>
				<li class="menu-header">Menu</li>
				<li class="nav-item">
					<a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> <span>Beranda</span></a>
				</li>
				<li class="nav-item">
					<a href="{{ route('cart') }}" class="nav-link"><i class="fas fa-cart-plus"></i> <span>Keranjang</span></a>
				</li>
				<li class="menu-header">Transaksi</li>
				<li class="nav-item">
					<a href="{{ route('transaction-customer.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Daftar Transaksi</span></a>
				</li>
				<li class="menu-header">Management Akun</li>
				<li class="nav-item">
					<a href="{{ route('profile-customer.index') }}" class="nav-link"><i class="fas fa-user"></i> <span>Profile</span></a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
				</li>
				<div class="mt-4 p-3 hide-sidebar-mini">
					@if (Auth::user()->status != 'PENDING')
						<form action="{{ route('open-store.edit', Auth::user()->id) }}">
							@csrf
							<button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split">
							<i class="fas fa-store"></i> Buka Toko Sekarang
							</button>     
						</form>                 
						@else
						<button class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#openStore">
							<i class="fas fa-store"></i> 
								{{ Auth::user()->status }}
						</button>
					@endif
				</div>
            </ul>
        </aside>
	@endif
</div>

<!-- Modal -->
<div class="modal fade" id="diblokirModal" tabindex="-1" aria-labelledby="diblokirModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="diblokirModalLabel">Akun Anda Diblokir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Dear {{ Auth::user()->name }},</strong><br>
		Akun Anda telah diblokir karena melakukan pelanggaran.<br>
		Silahkan hubungi admin untuk informasi lebih lanjut.
		<ul>
			<li>admin@buanastore.com</li>
			<li>0822-9502-4272 (Chat Only)</li>
		</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>