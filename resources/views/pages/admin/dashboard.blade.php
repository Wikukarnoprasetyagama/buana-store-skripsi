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
                <div class="card-icon shadow-info bg-info">
                  <i class="fas fa-store"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>SELLER</h4>
                  </div>
                  <div class="card-body">
                    {{ $seller }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-danger bg-danger">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>CUSTOMERS</h4>
                  </div>
                  <div class="card-body">
                    {{ $user }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-success bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>BALANCE</h4>
                  </div>
                  <div class="card-body">
                    Rp.{{ number_format($profit) }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-tags"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>PRODUK</h4>
                  </div>
                  <div class="card-body">
                    {{ $products }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-dark bg-dark">
                  <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>KATEGORI PRODUK</h4>
                  </div>
                  <div class="card-body">
                    {{ $category }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-warning bg-warning">
                  <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>MENUNGGU VERIFIKASI</h4>
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