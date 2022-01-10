      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if (Auth::user()->photo_profile == true)
							<img src="{{ Storage::url(Auth::user()->photo_profile) }}" class="img-fluid mr-2 rounded-circle w-100 h-100" style="max-height: 40px; max-width: 40px; border-radius: 50px; background-size: cover" alt="" />
							@else
							<img src="{{ url('/images/ic_avatar.svg') }}" class="img-fluid mr-2 rounded-circle w-100 h-100" style="max-height: 40px; max-width: 40px; border-radius: 50px; background-size: cover" alt="" />
						@endif
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('home') }}" class="dropdown-item has-icon">
                <i class="fas fa-home"></i> Beranda
              </a>
              <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
                <i class="fas fa-user"></i> Profile
              </a>
              <a href="{{ route('cart') }}" class="dropdown-item has-icon">
                <i class="fas fa-cart-plus"></i> Keranjang
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>