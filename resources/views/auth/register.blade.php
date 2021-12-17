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
              <img src="{{ url('frontend/images/logo.svg') }}" class="figure-img img-fluid" alt="" />
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
        <div class="row d-flex justify-content-center">
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
          <div class="col-2 col-lg-1 mb-3">
            <div class="d-grid text-center">
              <a href="#" class="img-fluid"
                ><img src="{{ url('frontend/images/ic_google.svg') }}" alt=""
              /></a>
            </div>
          </div>
          <div class="col-2 col-lg-1 mb-3">
            <div class="d-grid text-center">
              <a href="#" class="img-fluid"
                ><img src="{{ url('frontend/images/ic_facebook_1.svg') }}" alt=""
              /></a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
