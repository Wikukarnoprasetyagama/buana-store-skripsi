@extends('layouts.app')
@section('title')
    Detail Member Verifikasi
@endsection

@section('content')
@if ($detail->status == 'PENDING')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between pt-3">
                        <h1 class="h3 mb-0 text-gray-800">Detail Verifikasi Toko</h1>
                    </div>
                    <div class="details-name">
                        <p>{{ $detail->name_store }}</p>
                    </div>
                        <div class="row">
                            <div class="d-none d-md-block col-md-3">
                                <figure class="figure d-block">
                                    <img src="{{ Storage::url($detail->photo_profile) }}" class="img-thumbnail img-fluid figure-img w-100" alt="" style="height: 300px;">
                                </figure>
                            </div>
                            <div class="col-md-9">
                                <figure class="figure d-block">
                                    <img src="{{ Storage::url($detail->photo_shop) }}" class="img-thumbnail img-fluid figure-img w-100" alt="" style="height: 300px;">
                                </figure>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_store" class="form-label">Nama Toko</label>
                                    <input type="text" name="name_store" class="form-control" value="{{ $detail->name_store }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Nomor Telephon</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $detail->phone }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="village" class="form-label">Nama Desa</label>
                                    <input type="text" name="village" class="form-control" value="{{ $detail->village }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_bank" class="form-label">Nama Bank</label>
                                    <input type="text" name="name_bank" class="form-control" value="{{ $detail->name_bank }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_number" class="form-label">Nomor Rekening</label>
                                    <input type="text" name="account_number" class="form-control" value="{{ $detail->account_number }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="street" class="form-label">Nama Jalan</label>
                                    <input type="text" name="street" class="form-control" value="{{ $detail->street }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="address" class="form-control" value="{{ $detail->address }}" disabled>
                                </div>
                            </div>
                        </div>
                    <form action="{{ route('verification.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row d-flex justify-content-right">
                            <div class="col-lg-6">
                                <div class="btn-chat">
                                    <a href="https://api.whatsapp.com/send?phone=62{{ $detail->phone }}&text=Dear!%20{{ $detail->name }}" class="btn btn-block btn-info" target="_blank">Chat Member</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="hidden" name="roles" value="SELLER">
                                    <input type="hidden" name="status" value="TERVERIFIKASI">
                                    <button type="submit" class="btn btn-success btn-block change">Verifikasi Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row py-5">
                        <div class="col-md-12">
                            <div class="no-verification text-center">
                                <figure class="figure">
                                    <img src="{{ url('/images/ic_empty.svg') }}" class="img-fluid figure-img h-50 w-50" alt="">
                                </figure>
                                <div class="description">
                                    <h3>Belum ada Data!</h3>
                                    Tidak ada member yang perlu di verifikasi
                                </div>
                                <a href="{{ route('dashboard-admin') }}" class="btn btn-success mt-5">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection