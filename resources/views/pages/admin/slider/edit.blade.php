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
                        <h1 class="h3 mb-0 text-gray-800">Tambah Slider</h1>
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
                            <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="photo" class="form-control-label">Gambar</label>
                                <input type="file"
                                    name="photo"
                                    required 
                                    value="{{ old('photo') ? old('photo') : $slider->photo }}"
                                    class="form-control @error('photo') is-invalid @enderror"/>
                                @error('photo') <div class="text-muted">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Ubah Slider
                                </button>
                                <a href="{{ route('sliders.index') }}" class="btn btn-danger btn-block">
                                    Batal
                                </a>
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