@extends('layouts.seller')

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

                    <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Tambah Foto Max 4 & Hapus Gallery Photox --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_product" class="form-control-label">Nama Produk</label>
                                    <input type="text" name="name_product" value="{{ old('name_product') }}" class="form-control @error('name_product') is-invalid @enderror"/>
                                    @error('name_product') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categories_id" class="form-control-label">Kategori Produk</label>
                                    <select name="categories_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Harga Produk</label>
                                    <input type="number" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror"/>
                                    @error('price') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3" hidden>
                                <div class="form-group">
                                    <label for="users_id" class="form-control-label">Nama Toko</label>
                                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}" class="form-control @error('users_id') is-invalid @enderror"/>
                                    @error('users_id') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Kasih Diskon  / Tidak</label>
                                        <div class="form-check form-check-inline pt-2">
                                            <input class="form-check-input" type="radio" name="discount" id="inlineRadio1" value="Tidak">
                                            <label class="form-check-label" for="inlineRadio1">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="discount" id="inlineRadio2" value="Iya">
                                            <label class="form-check-label" for="inlineRadio2">Iya</label>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="dicount_amount" class="form-control-label">Jumlah Discount</label>
                                    <input type="number" name="dicount_amount" value="{{ old('dicount_amount') }}" class="form-control @error('dicount_amount') is-invalid @enderror"/>
                                    @error('dicount_amount') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="code_discount" class="form-control-label">Kode Discount</label>
                                    <input type="text" name="code_discount" value="{{ old('code_discount') }}" class="form-control @error('code_discount') is-invalid @enderror"/>
                                    @error('code_discount') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Isi Deskripsi Produk</label>
                                    <textarea name="description"
                                            class="ckeditor form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description') <div class="text-muted">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('products.index') }}" class="btn btn-danger btn-block">
                                    Batal
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary btn-block">
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
<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
         .create( document.querySelector( '.ckeditor' ) )
         .then( editor => {
                 console.log( editor );
         } )
         .catch( error => {
                 console.error( error );
         } );
 </script>


@endpush