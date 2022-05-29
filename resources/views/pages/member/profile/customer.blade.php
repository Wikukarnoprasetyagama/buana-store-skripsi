@extends('layouts.member')
@section('title')
    Profile Saya
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4 pt-3">
                        <h1 class="h3 mb-0 text-gray-800">Profile Saya</h1>
                        <div class="roles pt-3">
                            <p class="badge badge-warning">{{ $user->roles }}</p>
                        </div>
                    </div>
                    <div class="row">
                        {{-- photo profile --}}
                        <div class="col-12 col-md-2 text-center">
                            <form action="{{ route('profile-upload', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                @if ($user->photo_profile == true)
                                <figure class="figure" style="padding-top: 50px">
                                    <div class="form-group" onclick="profile()">
                                        <img src="{{ Storage::url($user->photo_profile) }}" class="figure-img img-fluid rounded-circle" alt="" style="max-height: 250px; background-size: cover" />
                                        
                                        <input type="file" id="profile" name="photo_profile" class="form-control" onchange="form.submit()" style="display: none" />
                                    </div>
                                </figure>
                            @else
                            <figure class="figure" style="padding-top: 50px">
                                <div class="form-group" onclick="profile()">
                                    <img src="{{ url('/images/ic_avatar.svg') }}" class="figure-img img-fluid rounded-circle" alt="" style="max-height: 250px; background-size: cover" />

                                    <input type="file" id="profile" name="photo_profile" class="form-control" onchange="form.submit()" style="display: none" />
                                </div>
                            </figure>
                            @endif

                            </form>
                        </div>

                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label">Nomor Telephone</label>
                                        <input type="number" name="phone" class="form-control" value="{{ $user->phone }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="provinces_id" class="form-label">Provinsi</label>
                                            <input type="text" name="provinces_id" class="form-control" 
                                            value="{{ App\Models\Province::find($user->provinces_id)->name ?? '' }}" 
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="regencies_id" class="form-label">Kabupaten</label>
                                        <input type="text" name="regencies_id" class="form-control" 
                                        value="{{ App\Models\Regency::find($user->regencies_id)->name ?? '' }}" 
                                        disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="districts_id" class="form-label">Kecamatan</label>
                                        <input name="districts_id" class="form-control text-left" 
                                        value="{{ App\Models\District::find($user->districts_id)->name ?? '' }}" 
                                        disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label">Alamat Lengkap Rumah</label>
                                        <textarea name="address" 
                                        class="form-control text-left"
                                        style="height: 120px"
                                        disabled>{{ $user->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="{{ route('dashboard-customer') }}" class="btn btn-secondary d-block text-dark">Kembali</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="{{ route('profile-customer.edit', $user->id) }}" class="btn btn-primary d-block">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>
<script>
    function profile() {
        document.getElementById('profile').click();
    }
</script>
@endpush

@push('after-style')
    <style>
        figure{
            cursor: pointer;
        }
    </style>
@endpush