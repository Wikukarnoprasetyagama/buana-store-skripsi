@extends('layouts.auth')

@section('content')
    <section class="section-login">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <div class="figure">
              <img src="{{ url('frontend/images/logo.svg') }}" class="figure-img img-fluid" alt="" />
              <h1>Selamat Datang</h1>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <p>
              Silahkan masuk untuk belanja kebutuhan favorit anda dan keluarga
            </p>
          </div>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="row mt-3 d-flex justify-content-center">
            <div class="col-12 col-lg-4">
                <label for="email" class="form-label">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    aria-describedby="emailhelp"
                    autofocus
                />

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
            <div class="col-12 col-lg-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('passowrd') is-invalid @enderror " />

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>
            <div class="row mt-4 d-flex justify-content-center">
            <div class="col-12 col-lg-4 mb-3">
                <div class="d-grid">
                <button type="submit" class="btn text-white btn-daftar">Login Now</button>
                </div>
            </div>
            </div>
            <div class="row text-center">
            <div class="col-12 col-lg-12">
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            </div>
    
        </form>
            <div class="row d-flex justify-content-center mt-4">
            <div class="col-12 col-lg-1 mb-3">
                <div class="d-grid text-center">
                <a href="{{ '/auth/redirect' }}" class="img-fluid"
                    ><img src="{{ url('frontend/images/ic_google.svg') }}" alt=""
                /></a>
                </div>
            </div>
            <div class="col-12 col-lg-1 mb-3">
                <div class="d-grid text-center">
                <a href="#" class="img-fluid"
                    ><img src="{{ url('frontend/images/ic_facebook_1.svg') }}" alt=""
                /></a>
                </div>
            </div>
            </div>
            <div class="row d-flex justify-content-center mb-sm-3">
            <div class="col-12 col-lg-4 text-center already-account">
                <hr />
                <span
                >Don't have an account? <a href="{{ route('register') }}">Sign Up</a></span
                >
            </div>
            </div>
      </div>
    </section>
@endsection
