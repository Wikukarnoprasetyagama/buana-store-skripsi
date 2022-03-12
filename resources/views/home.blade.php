@extends('layouts.home')

@section('title')
    Beranda
@endsection

@section('content')
<!-- Carousel -->
    <section class="section-content-carousel">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="title">
              <span>Belanja Sepuasnya,</span>
              <h1>
                Dapatkan Diskon <span>20%</span> <br />
                di Setiap <span>Produk</span> Kami
              </h1>
              {{-- <h1>
                Diskon <span>30 % </span> Untuk <br />
                <span>Member Baru </span>
              </h1> --}}
            </div>
            <p class="subtitle">
              Jelajahi barang kebutuhan anda & dapatkan <br />
              diskon setiap bulannya
            </p>
            @guest
                <a href="{{ route('login') }}" class="btn btn-lg btn-get-now">Dapatkan Sekarang</a>
            @endguest
            @auth
                <a href="#product" class="btn btn-lg btn-get-now">Dapatkan Sekarang</a>
            @endauth
          </div>
          <div class="col-lg-4 offset-2 d-none d-lg-block">
            <div class="row">
              <div class="col-lg-12">
                <div class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner rounded">
                    @foreach ($brands as $key => $brand)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                          <figure class="figure">
                            <img src="{{ Storage::url($brand->photo) }}" class="img-fluid figure-img d-block w-100 h-100" alt="...">
                          </figure>
                        </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Category -->
    <section class="section-category">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 title">
            <h3>Kategori Produk</h3>
            <p>Cari barang sesuai dengan kategori</p>
          </div>
          <div class="col-12 col-md-6 text-end d-none d-lg-block text-md-end my-auto">
            <a href="{{ route('all-category') }}" class="next-category">Selengkapnya</a>
          </div>
        </div>
        <div class="row mt-3">
          @php
              $incerementCategory = 0
          @endphp
          @foreach ($categories as $category)
          <div class="col-4 col-lg-2 text-center mb-3">
            <a href="{{ route('categories-detail', $category->slug) }}">
              <div class="bg-category" data-aos="zoom-in" data-aos-delay="{{ $incerementCategory +=100 }}">
                <figure class="figure pt-3">
                  <img src="{{ Storage::url($category->photo) }}" class="img-fluid" alt="" />
                  <p class="mt-2 d-none d-md-block d-lg-block">{{ $category->name_category }}</p>
                </figure>
              </div>
            </a>
          </div>
          @endforeach
        </div>
		<div class="col-12 d-md-none d-lg-none d-xl-none text-center mt-5">
          <a href="{{ route('all-category') }}" class="next-category">Selengkapnya</a>
        </div>
      </div>
    </section>

    <!-- New Product -->
    <section class="section-product" id="product">
      	<div class="container">
			<div class="row">
			<div class="col-12 col-md-6">
				<h3>Produk Baru</h3>
				<p>Pilih barang terbaru dari kami</p>
			</div>
			<div class="col-12 col-md-6 text-end my-auto d-none d-lg-block text-md-end my-auto">
				<a href="#" class="next-category">Selengkapnya</a>
			</div>
			</div>
        	<div class="row mt-2">
				@php
					$incerementProduct = 0
				@endphp
				@forelse ($products as $product)
					@if ($product->user->status == "TERVERIFIKASI")
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
          @endif
				@empty
				<div class="product-empty text-center pt-5">
					<span>Belum ada produk!</span>
				</div>
				@endforelse
			</div>
			<div class="col-12 d-md-none d-lg-none d-xl-none text-center mt-5">
				<a href="#" class="next-category">Selengkapnya</a>
			</div>
    	</div>
    </section>
@endsection
