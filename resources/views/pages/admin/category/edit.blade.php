@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h5>Edit Kategori</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="photo" class="form-control-label">Gambar</label>
                                <input type="file"
                                    name="photo"
                                    required 
                                    value="{{ old('photo') ? old('photo') : $category->photo }}"
                                    class="form-control @error('photo') is-invalid @enderror"/>
                                @error('photo') <div class="text-muted">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_category" class="form-control-label">Nama Kategori</label>
                                <input type="text" name="name_category" value="{{ old('name_category') ? old('name_category') : $category->name_category }}" class="form-control @error('name_category') is-invalid @enderror"/>
                                @error('name_category') <div class="text-muted" required>{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="{{ route('category.index') }}" class="btn btn-danger btn-block">
                                    Batal
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Ubah Kategori
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection