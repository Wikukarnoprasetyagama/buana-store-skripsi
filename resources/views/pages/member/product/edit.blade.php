@extends('layouts.member')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Edit Slider</strong>
        </div>
        <div class="card-body card-block">
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
@endsection