@extends('layouts.auth')

@section('title')
    DAFTAR SEKARANG
@endsection

@section('content')
    <section class="section-register">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <div class="figure">
              <img src="{{ url('/images/logo.svg') }}" class="figure-img img-fluid" alt="" />
              <h1>Daftar Sekarang</h1>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <p>Mulai kembangkan bisnis anda dengan cara terbaru bersama kami</p>
          </div>
        </div>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-3 d-flex justify-content-center">
            <div class="col-12 col-lg-3">
                <label for="email" class="form-label">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    aria-describedby="emailhelp"
                    autofocus
                    required
                />

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-lg-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" required class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
            <div class="col-12 col-lg-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" required name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            <div class="col-12 col-lg-3">
                <label for="password-confirm" class="form-label">Conform Password</label>
                <input type="password" required name="password_confirmation" class="form-control" required autocomplete="new-password" />
            </div>
            </div>
            <div class="row mt-4 d-flex justify-content-center">
            <div class="col-12 col-lg-6 mb-3">
                <div class="d-grid">
                <button type="submit" class="btn btn-daftar">
                    Daftar Sekarang</button>
                </div>
            </div>
            </div>
        </form>
        <div class="row d-flex justify-content-center already-account">
          <div class="col-md-6 text-center">
            <span>Already have an account? <a href="{{ route('login') }}">Sign In</a></span>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-lg-5">
            <hr />
          </div>
        </div>
        <div class="row d-flex justify-content-center mb-sm-3 mt-3">
          <div class="col-12 col-lg-6 mb-3">
            <div class="d-grid text-center">
              <a href="{{ url('auth/redirect') }}" class="btn btn-google-register" style="background-color: #dfdfdf"
                ><img src="{{ url('/images/ic_google.svg') }}" class="me-4" alt=""
              />Daftar dengan Google</a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
