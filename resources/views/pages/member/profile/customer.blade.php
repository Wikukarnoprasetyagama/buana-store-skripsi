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
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-2 text-center">
                            @if ($user->photo_profile == true)
                                <figure class="figure" style="padding-top: 50px">
                                    <img src="{{ Storage::url($user->photo_profile) }}" class="figure-img img-fluid rounded-circle" alt="" style="max-height: 250px; background-size: cover" />
                                </figure>
                            @else
                            <figure class="figure" style="padding-top: 50px">
                                <img src="{{ url('/images/ic_avatar.svg') }}" class="figure-img img-fluid rounded-circle" alt="" style="max-height: 250px; background-size: cover" />
                            </figure>
                            @endif
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Nama</label>
                                        <input type="email" class="form-control" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Nomor Telephone</label>
                                        <input type="text" class="form-control" value="{{ $user->phone }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Role</label>
                                            <input type="text" class="form-control" value="{{ $user->roles }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Desa</label>
                                        <input type="text" class="form-control" value="{{ $user->village }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Jalan</label>
                                            <input type="text" class="form-control" value="{{ $user->street }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Alamat Lengkap</label>
                                        <input name="address" class="form-control text-left" value="{{ $user->address }}" disabled>
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
@endpush