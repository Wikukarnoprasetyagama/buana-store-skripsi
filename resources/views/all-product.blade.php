@extends('layouts.home')

@section('title')
    Semua Produk
@endsection

@section('content')

<section class="section-all-product mt-3">
  <div class="container">
	<div class="row section-title">
		<div class="col-12 title text-center">
			<h3>Semua Produk</h3>
			<p>Cari barang sesuai dengan yang kamu inginkan disini</p>
		</div>
	</div>
	<div class="row section-search-product d-flex justify-content-center">
		<div class="col-12 col-md-6">
			<form action="/semua-produk">
				@csrf
				<div class="input-group d-flex">
					<input type="text" class="form-control" value="{{ request('search-product') }}" name="search-product" id="search-product" placeholder="Mau cari apa ?">
					<button type="submit" class="btn btn-search text-white"><i class="fas fa-search"></i></button>
				</div>
		</div>
	</div>
	<div class="row section-product">
		@forelse ($products as $product)
			@if ($product->user->status == "TERVERIFIKASI")
              	<div class="col-6 col-lg-3 mb-3">
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
					@if ($product->stock == 'Habis')
						<span class="badge bg-danger fw-normal">Habis</span>
					@endif
				</div>
          	@endif
		@empty
			<div class="product-empty text-center">
				<figure class="figure">
					<img src="{{ url('/images/no_product.svg') }}" class="figure-img img-fluid" alt="">
					<h3>Mohon Maaf!</h3>
					<p>Produk yang anda cari belum tersedia.</p>
				</figure>
			</div>
		@endforelse
	</div>
	<div class="paginate-product mt-5 d-flex justify-content-center">
		{{ $products->links() }}
	</div>
  </div>
</section>
@endsection
