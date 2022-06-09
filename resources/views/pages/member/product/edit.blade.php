@extends('layouts.member')

@section('content')
    <!-- Begin Page Content -->
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Page Heading -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Update Produk</h1>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        @forelse ($products->galleries as $gallery)
                            <div class="col-6 col-md-3 mb-3">
                                <figure class="figure gallery-container mb-3">
                                    <img src="{{ Storage::url($gallery->photo) }}" class="w-100 img-fluid figure-img" alt="" />
                                    <a href="{{ route('delete-gallery-product', $gallery->id) }}" class="delete-gallery">
                                        <img src="/images/icon-delete.svg" class="img-fluid w-75 h-75" alt="icon-delete" />
                                    </a>
                                </figure>
                            </div>
                        @empty
                            <div class="col-md-12 mb-3">
                                <div class="text-center">
                                    <p>Tidak ada gambar produk!</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            <form action="{{ route('update-product-gallery', $products->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="products_id" value="{{ $products->id }}">
                                <input type="file" name="photo[]" multiple id="file" style="display: none" onchange="form.submit()" />
                                <button class="btn btn-secondary btn-block mt-2" type="button" onclick="thisFileUpload()">
                                    Add Photo
                                </button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('products-seller.update', $products->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf       
                        @method('PUT')   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_product" class="form-control-label">Nama Produk</label>
                                    <input type="text" id="name_product" name="name_product" value="{{ $products->name_product }}" class="form-control @error('name_product') is-invalid @enderror"/>
                                    @error('name_product') <div class="text-muted">{{ $message }}</div> @enderror
                                    @error('name_product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categories_id" class="form-control-label">Kategori Produk</label>
                                    <select name="categories_id" class="form-control">
                                        @foreach ($categories as $category)
                                            @if ($category->id == $products->categories_id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name_category }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Harga Produk</label>
                                    <input type="number" name="price" value="{{ $products->price }}" class="form-control @error('price') is-invalid @enderror"/>
                                    @error('price') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Kasih Diskon  / Tidak</label>
                                        <select class="form-control" name="discount">
                                            <option id="discount1" value="1" {{ $products->discount == 1 ? 'selected' : '' }}>Kasih Diskon</option>
                                            <option id="discount0" value="0" {{ $products->discount == 0 ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_amount" class="form-control-label">Jumlah Discount</label>
                                    <input type="number" name="discount_amount" id="discount_amount" value="{{ $products->discount_amount }}" class="form-control discount_amount inputDisabledDiscount @error('discount_amount') is-invalid @enderror"/>
                                    @error('discount_amount') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ongkir" class="form-control-label">Kasih Ongkir  / Tidak</label>
                                    <select class="form-control" name="ongkir" id="ongkir">
                                        <option id="ongkir1" value="1" {{ $products->ongkir == 1 ? 'selected' : '' }}>Kasih Ongkir</option>
                                        <option id="ongkir0" value="0" {{ $products->ongkir == 0 ? 'selected' : '' }}>Gratis Ongkir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ongkir_amount" class="form-control-label">Ongkos Kirim</label>
                                    <input type="number" name="ongkir_amount" id="ongkir_amount" value="{{ $products->ongkir_amount }}" class="form-control inputDisabledOngkir @error('ongkir_amount') is-invalid @enderror"/>
                                    @error('ongkir_amount') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Isi Deskripsi Produk</label>
                                    <textarea name="description" style="height: 70px"
                                            class="ckeditor form-control @error('description') is-invalid @enderror">{{ $products->description }}</textarea>
                                    @error('description') <div class="text-muted">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('products-seller.index') }}" class="btn btn-danger btn-block">
                                    Batal
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-success btn-block">
                                    Simpan
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

@push('after-script')
    {{-- upload gambar --}}
    <script>
        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
    {{-- ubah diskon --}}
    <script>
        const discount_amount = document.getElementById('discount_amount');
        const discount0 = document.querySelector('#discount0');
        const discount1 = document.querySelector('#discount1');
        if ($('#discount1').is(':selected')) {
            if ($('.form-control').change(function(){
                discount_amount.setAttribute('value', '0');
            })) {
                
            }else{
                discount_amount.value = discount_amount.value;
            }
        } 
    </script>
    {{-- ubah ongkir --}}
    <script>
        const ongkir_amount = document.getElementById('ongkir_amount');
        const ongkir0 = document.querySelector('#ongkir0');
        const ongkir1 = document.querySelector('#ongkir1');
        if ($('#ongkir1').is(':selected')) {
            if ($('.form-control').change(function(){
                ongkir_amount.setAttribute('value', '0');
            })) {
                
            }else{
                ongkir_amount.value = ongkir_amount.value;
            }
        }
    </script>
@endpush

@push('after-style')
    <style>
        .gallery-container {
            margin-bottom: 20px;
            max-height: 160px;
        }
        .gallery-container img{
            border-radius: 8px;
        }
        .delete-gallery {
            display: block;
            position: absolute;
            top: -10px;
            right: 0;
        }
    </style>
@endpush