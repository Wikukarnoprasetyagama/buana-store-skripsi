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
            Kategori 
          </li>
        </ol>
      </div>
    </nav>
<!-- Category -->
    <section class="section-category">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 title">
            <h3>Semua Kategori Produk</h3>
            <p>Cari barang sesuai dengan kategori</p>
          </div>
        </div>
        <div class="row mt-3">
			@php
				$incerementCategory = 0;
			@endphp
          @foreach ($categories as $category)
          <div class="col-4 col-lg-2 text-center mb-2">
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
      </div>
    </section>
    <!-- End Category -->
@endsection