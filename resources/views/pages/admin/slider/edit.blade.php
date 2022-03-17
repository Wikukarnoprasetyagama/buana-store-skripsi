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
                        <h1 class="h3 mb-0 text-gray-800">Edit Slider <span>"{{ $slider->name }}"</span></h1>
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
                            <form action="{{ route('sliders.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="photo" class="form-control-label">Foto</label>
                                            <input  type="file"
                                                    name="photo" 
                                                    value="{{ old('photo') }}" 
                                                    accept="image/*"
                                                    class="form-control @error('photo') is-invalid @enderror"/>
                                            @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Nama Slider / Iklan</label>
                                            <input type="text" name="name" value="{{ $slider->name }}" class="form-control @error('name') is-invalid @enderror"/>
                                            @error('name') <div class="text-muted" required>{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <a href="{{ route('sliders.index') }}" class="btn btn-danger btn-block">
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