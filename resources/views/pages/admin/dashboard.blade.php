@extends('layouts.app')

@section('title')
    Admin Food Market
@endsection

@section('content')
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-store"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Seller</h4>
                  </div>
                  <div class="card-body">
                    {{ $seller }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>User</h4>
                  </div>
                  <div class="card-body">
                    {{ $user }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Balance</h4>
                  </div>
                  <div class="card-body">
                    $187,13
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-store"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Produk</h4>
                  </div>
                  <div class="card-body">
                    {{ $products }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Kategori Produk</h4>
                  </div>
                  <div class="card-body">
                    {{ $category }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-cart-plus"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Slide / Banner</h4>
                  </div>
                  <div class="card-body">
                    {{ $sliders }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-success bg-success">
                  <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Menunggu Verifikasi</h4>
                  </div>
                  <div class="card-body">
                    {{ $open_store }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection