@extends('layouts.customer')

@section('content')
<!-- Begin Page Content -->
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Page Heading -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Buka Toko</h1>
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
                    <form action="{{ route('open-store.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="photo_profile" class="form-control-label">Foto Profile</label>
                                    <input  type="file"
                                            name="photo_profile" 
                                            value="{{ old('photo_profile') }}" 
                                            required
                                            multiple
                                            class="form-control @error('photo_profile') is-invalid @enderror"/>
                                    @error('photo_profile') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_store" class="form-control-label">Nama Toko</label>
                                    <input type="text" name="name_store" class="form-control @error('name_store') is-invalid @enderror">
                                    @error('name_store') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Nomor Telephone (aktif)</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo_shop" class="form-control-label">Foto Toko</label>
                                    <input  type="file"
                                            name="photo_shop" 
                                            value="{{ old('photo_shop') }}" 
                                            required
                                            class="form-control @error('photo_shop') is-invalid @enderror"/>
                                    @error('photo_shop') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="village" class="form-control-label">Nama Desa</label>
                                    <input type="text" name="village" value="{{ old('village') }}" class="form-control @error('village') is-invalid @enderror"/>
                                    @error('village') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Isi Alamat Lengkap Toko</label>
                                    <textarea name="address" placeholder="Contoh: Sp. 2 Umum, Jln. subakti, RT/RW 03/01 depan kantor camat"
                                            class="ckeditor form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address') <div class="text-muted">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="{{ route('dashboard-customer') }}" class="btn btn-danger btn-block">
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