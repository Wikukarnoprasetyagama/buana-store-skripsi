@extends('layouts.app')

@section('title')
    Detail Transaksi
@endsection

@section('content')
<div class="main-content">

    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Detail Transaksi Member</h1>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <figure class="text-center">
                        <img class="figure-img img-fluid rounded-circle w-100 h-100" style="max-height: 150px; max-width: 150px;  background-size: cover;"
                            src="#"
                            alt="User profile picture">
                        </figure>
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">{{ $user->roles }}</p>
                        <a href="#" class="btn btn-success btn-block"><b>Chat Sekarang</b></a>
                    </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                  <div class="row">
                    @foreach ($products as $product)
                      <div class="col-md-3">
                          <figure class="figure">
                              @if ($product->galleries->count())
                                  <img src="{{ Storage::url($product->galleries->first()->photo) }}" class="figure-img img-fluid rounded" alt="...">
                              @endif
                          </figure>
                      </div>
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection