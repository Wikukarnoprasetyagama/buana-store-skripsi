@extends('layouts.home')

@section('title')
    Kategori Semua Produk
@endsection

@section('content')
<!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
          <li class="breadcrumb-item active my-auto" aria-current="page">
            Kategori {{ $category->name_category }}
          </li>
        </ol>
      </div>
    </nav>
<!-- Category -->
    <section class="section-product-category">
      <div class="container">
        <div class="row">
          <div class="col-12 title text-center">
            <h3>Semua Kategori Produk {{ $category->name_category }}</h3>
            <p>Cari {{ $category->name_category }} sesuai dengan yang kamu inginkan</p>
          </div>
        </div>
        <div class="row mt-3">
          @php
            $incerementProduct = 0;
          @endphp
          @forelse ($products as $product)
            <div class="col-6 col-lg-3 mb-3" data-aos="zoom-in" data-aos-delay="{{ $incerementProduct += 100 }}">
              <figure class="figure">
              <div class="product-img">
                <a href="{{ route('detail', $product->slug) }}">
                @if ($product->galleries->count())
                  <img
                  src="{{ Storage::url($product->galleries->first()->photo) }}"
                  class="figure-img img-fluid w-100"
                  alt=""
                />
                @endif
                </a>
                @if ($product->discount == true)
                  <div class="discount-image d-flex justify-content-end">
                  <img
                    src="{{ url('/images/ic_discount_empty.svg') }}"
                    class="align-items-end img-fluid"
                    alt=""
                  />
                  <div class="discount-badge">{{ $product->discount_amount }}%</div>
                </div>
                @endif
              </div>
              </figure>
              <h4 class="name-product">{{ $product->name_product }}</h4>
              <div class="price">Rp. {{ number_format($product->price) }}</div>
            </div>
          @empty
            <div class="product-empty text-center pt-5">
              <span>Belum ada produk!</span>
            </div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- End Category -->
@endsection