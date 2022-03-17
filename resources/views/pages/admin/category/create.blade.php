@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Page Heading -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Produk</h1>
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

                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('category.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="photo" class="form-control-label">Foto</label>
                                            <input  type="file"
                                                    name="photo" 
                                                    value="{{ old('photo') }}" 
                                                    accept="image/*"
                                                    required
                                                    class="form-control @error('photo') is-invalid @enderror"/>
                                            @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_category" class="form-control-label">Nama Kategori Produk</label>
                                            <input type="text" name="name_category" value="{{ old('name_category') }}" class="form-control @error('name_category') is-invalid @enderror"/>
                                            @error('name_category') <div class="text-muted" required>{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <a href="{{ route('category.index') }}" class="btn btn-danger btn-block">
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
    </div>
</div>
@endsection