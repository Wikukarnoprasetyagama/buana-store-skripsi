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
                        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
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
                    <form action="{{ route('products-seller.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf                  
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}"/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo" class="form-control-label">Foto</label>
                                    <input  type="file"
                                            name="photo[]" 
                                            value="{{ old('photo') }}" 
                                            multiple
                                            class="form-control @error('photo') is-invalid @enderror"/>
                                    @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
                                    <span>* Kamu dapat upload lebih dari 1 foto</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_product" class="form-control-label">Nama Produk</label>
                                    <input type="text" id="name_product" name="name_product" value="{{ old('name_product') }}" class="form-control @error('name_product') is-invalid @enderror"/>
                                    @error('name_product') <div class="text-muted" required>{{ $message }}</div> @enderror
                                    @error('name_product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories_id" class="form-control-label">Kategori Produk</label>
                                    <select name="categories_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Harga Produk</label>
                                    <input type="number" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror"/>
                                    @error('price') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row" id="discount">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount" class="form-control-label">Kasih Diskon  / Tidak (opsional)</label>
                                        <select class="form-control" name="discount" id="discount">
                                            <option value="0">Tidak</option>
                                            <option value="1">Kasih Diskon</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_amount" class="form-control-label">Jumlah Discount</label>
                                    <input type="number" name="discount_amount" value="{{ old('discount_amount') }}" class="form-control inputDisabledDiscount @error('discount_amount') is-invalid @enderror"/>
                                    @error('discount_amount') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" id="ongkir">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ongkir" class="form-control-label">Free Ongkir  / Tidak (opsional)</label>
                                        <select class="form-control" name="ongkir" id="ongkir">
                                            <option value="0">Tidak</option>
                                            <option value="1">Kasih Ongkir</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ongkir_amount" class="form-control-label">Ongkos Kirim</label>
                                    <input type="number" name="ongkir_amount" value="{{ old('ongkir_amount') }}" class="form-control inputDisabledOngkir @error('ongkir_amount') is-invalid @enderror"/>
                                    @error('ongkir_amount') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Isi Deskripsi Produk</label>
                                    <textarea name="description" style="height: 70px"
                                            class="ckeditor form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description') <div class="text-muted">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
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

<script>
    $(".discount").click(function(){
        if ($(this).prop('checked')) {
            $('.inputDisabledDiscount').prop("disabled", false);
        } else {
            $('.inputDisabledDiscount').prop("disabled", true);
        }
    });

    $(".ongkir").click(function(){
        if ($(this).prop('checked')) {
            $('.inputDisabledOngkir').prop("disabled", false);
        } else {
            $('.inputDisabledOngkir').prop("disabled", true);
        }
    });
</script>

<script>
    const name_product = document.querySelector('#name_product');
    const slug = document.querySelector('#slug');
    

    name_product.addEventListener('change', function(){
        fetch('/pages/dashboard/seller/products-seller/checkSlug?name_product=' + name_product.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug);
    });
</script>
@endpush