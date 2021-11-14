<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="{{ url('frontend/images/logo.svg') }}" class="img-fluid" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item mx-2">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Category</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Store</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Rewards</a>
            </li>

            {{-- Jika Belum Login --}}

            @guest
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
              </li>
              <li class="nav-item mx-2">
                <a
                  class="btn btn-sign-up nav-link px-4 text-white"
                  href="{{ route('register') }}"
                  >Sign Up</a
                >
              </li>
            @endguest

            {{-- Jika Sudah Login --}}
            @auth
                @if (Auth::user()->roles == 'ADMIN')
                  <li class="nav-item mx-2">
                      <a class="nav-link" href="{{ route('dashboard-admin') }}">{{ Auth::user()->name }}</a>
                  </li>
                @endif
                @if (Auth::user()->roles == 'SELLER')
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('dashboard-seller') }}">{{ Auth::user()->name }}</a>
                      </li>
                @endif
                @if (Auth::user()->roles == 'USER')
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('dashboard-user') }}">{{ Auth::user()->name }}</a>
                      </li>
                @endif
            @endauth

          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->