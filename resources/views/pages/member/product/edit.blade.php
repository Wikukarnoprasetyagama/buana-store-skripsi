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
                        @forelse ($product->galleries as $gallery)
                            <div class="col-md-3">
                                <figure class="figure gallery-container">
                                    <img src="{{ Storage::url($gallery->photo) }}" class="w-100 img-fluid figure-img" alt="" />
                                    <a href="{{ route('delete-gallery-product', $gallery->id) }}" class="delete-gallery">
                                        <img src="/images/icon-delete.svg" alt="" />
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
                            <form action="{{ route('update-product-gallery', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="products_id" value="{{ $product->id }}">
                                <input type="file" name="photo[]" multiple id="file" style="display: none" onchange="form.submit()" />
                                <button class="btn btn-secondary btn-block mt-2" type="button" onclick="thisFileUpload()">
                                    Add Photo
                                </button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('products-seller.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf       
                        @method('PUT')   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_product" class="form-control-label">Nama Produk</label>
                                    <input type="text" id="name_product" name="name_product" value="{{ $product->name_product }}" class="form-control @error('name_product') is-invalid @enderror"/>
                                    @error('name_product') <div class="text-muted" required>{{ $message }}</div> @enderror
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
                                            @if ($category->id == $product->categories_id)
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
                                    <input type="number" name="price" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror"/>
                                    @error('price') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row" id="discount">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Kasih Diskon  / Tidak</label>
                                        <div class="form-group form-check py-2" id="checkbox">
                                            @if ($product->discount == true)
                                                <input type="checkbox" class="form-check-input discount" name="discount" value="1" checked>
                                            @else
                                                <input type="checkbox" class="form-check-input discount" name="discount" value="1">
                                            @endif
                                            <label class="form-check-label" for="exampleCheck1">Kasih Diskon</label>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_amount" class="form-control-label">Jumlah Discount</label>
                                    <input type="number" name="discount_amount" value="{{ $product->discount_amount }}" class="form-control inputDisabledDiscount @error('discount_amount') is-invalid @enderror"/>
                                    @error('discount_amount') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" id="ongkir">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ongkir" class="form-control-label">Free Ongkir  / Tidak</label>
                                        <div class="form-group form-check py-2" id="checkbox">
                                            @if ($product->ongkir == true)
                                                <input type="checkbox" class="form-check-input ongkir" name="ongkir" value="1" checked>
                                            @else
                                                <input type="checkbox" class="form-check-input ongkir" name="ongkir" value="1">
                                            @endif
                                            <label class="form-check-label" for="exampleCheck1">Kasih Ongkir</label>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ongkir_amount" class="form-control-label">Ongkos Kirim</label>
                                    <input type="number" name="ongkir_amount" value="{{ $product->ongkir_amount }}" class="form-control inputDisabledOngkir @error('ongkir_amount') is-invalid @enderror"/>
                                    @error('ongkir_amount') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Isi Deskripsi Produk</label>
                                    <textarea name="description" style="height: 70px"
                                            class="form-control @error('description') is-invalid @enderror">{{ $product->description }}</textarea>
                                    @error('description') <div class="text-muted">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('products-admin.index') }}" class="btn btn-danger btn-block">
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
    <script>
        function thisFileUpload() {
            document.getElementById("file").click();
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