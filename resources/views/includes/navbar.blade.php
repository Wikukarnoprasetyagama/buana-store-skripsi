<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="{{ url('/images/logo.svg') }}" class="img-fluid" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item mx-2">
					<a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Beranda</a>
				</li>
				<li class="nav-item mx-2">
					<a class="nav-link {{ (request()->is('semua-kategori-produk*')) ? 'active' : '' }}" href="{{ route('all-category') }}">Kategori</a>
				</li>
				<li class="nav-item mx-2">
					<a class="nav-link {{ (request()->is('semua-produk*')) ? 'active' : '' }}" href="{{ route('all-product') }}">Produk</a>
				</li>
				<li class="nav-item mx-2">
					<a class="nav-link {{ (request()->is('hadiah*')) ? 'active' : '' }}" href="{{ route('reward') }}">Hadiah</a>
				</li>
				@auth
				<li class="nav-item mx-2">
					<a href="{{ route('cart') }}">
						@php
							$carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
						@endphp
						<img src="{{ url('/images/ic_cart.svg') }}" class="img-fluid my-auto" alt=""/>
						@if ($carts > 0)
									<div class="cart-badge">{{ $carts }}</div>
						@endif
					</a>
				</li>
				@endauth
				{{-- Jika Belum Login --}}
				@guest
					<li class="nav-item mx-2">
					<a class="nav-link" href="{{ route('login') }}">Masuk</a>
					</li>
					<li class="nav-item d-none d-md-block mx-2">
					<a
						class="btn btn-sign-up nav-link px-4 text-white"
						href="{{ route('register') }}"
						>Daftar</a
					>
					</li>
					<li class="nav-item d-sm-block d-md-none mx-2 d-grid">
					<a
						class="btn btn-sign-up nav-link px-4 text-white"
						href="{{ route('register') }}"
						>Daftar</a
					>
					</li>
				@endguest
          </ul>
          <ul class="navbar-nav ms-2">
				@auth
					<li class="nav-item">
						@if (Auth::user()->roles == 'ADMIN')
							<a href="{{ route('dashboard-admin') }}" class="nav-link d-block d-md-block d-lg-none">
								Hi, {{ Auth::user()->name }}
							</a>
							@elseif (Auth::user()->roles == 'SELLER')
							<a href="{{ route('dashboard-seller') }}" class="nav-link d-block d-md-block d-lg-none">
								Hi, {{ Auth::user()->name }}
							</a>
							@else
							<a href="{{ route('dashboard-customer') }}" class="nav-link d-block d-md-block d-lg-none">
								Hi, {{ Auth::user()->name }}
							</a>
						@endif
					</li>
					<li class="nav-item">
					<a href="#" class="nav-link d-block d-md-block d-lg-none" data-bs-toggle="modal" data-bs-target="#exampleModal"
						>Keluar</a>
					</li>
				@endauth
          </ul>
          <div class="dropdown">
            <a
              class="ms-3 d-none d-lg-block"
              href="#"
              id="dropdownMenuLink"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
            @auth
				<div class="d-flex align-item-center">
					<div class="flex-shrink-0 pt-2">
						Hi, {{ Auth::user()->name }}	
					</div> 	
					<div class="flex-grow-1 ms-2">
						@if (Auth::user()->photo_profile == true)
							<img src="{{ Storage::url(Auth::user()->photo_profile) }}" class="img-fluid ms-2 rounded-circle w-100 h-100" style="max-height: 40px; max-width: 40px; border-radius: 50px; background-size: cover" alt="" />
							@else
							<img src="{{ url('/images/ic_avatar.svg') }}" class="img-fluid ms-2 rounded-circle w-100 h-100" style="max-height: 40px; max-width: 40px; border-radius: 50px; background-size: cover" alt="" />
						@endif
					</div>
				</div> 
			@endauth
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li>
				  @auth
						@if (Auth::user()->roles == 'ADMIN')
							<a class="dropdown-item" href="{{ route('dashboard-admin') }}">Akun Saya</a>
							@elseif (Auth::user()->roles == 'SELLER')
							<a class="dropdown-item" href="{{ route('dashboard-seller') }}">Akun Saya</a>
							@else
							<a class="dropdown-item" href="{{ route('dashboard-customer') }}">Akun Saya</a>
						@endif
					@endauth
			  </li>
              <li class="nav-item">
				<a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"
					>Keluar</a>
			</li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
