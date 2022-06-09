@extends('layouts.member')

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
                    <form action="{{ route('open-store.update', $open->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf   
                        @method('PUT')
                        <input type="hidden" name="status" value="PENDING">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="photo_profile" class="form-control-label">Foto Profile</label>
                                    <input  type="file"
                                            name="photo_profile" 
                                            value="{{ old('photo_profile') }}" 
                                            accept="image/*"
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
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="photo_shop" class="form-control-label">Foto Toko</label>
                                    <input  type="file"
                                            name="photo_shop" 
                                            value="{{ old('photo_shop') }}" 
                                            required
                                            accept="image/*"
                                            class="form-control @error('photo_shop') is-invalid @enderror"/>
                                    @error('photo_shop') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="village" class="form-control-label">Nama Desa</label>
                                    <input type="text" name="village" value="{{ old('village') }}" class="form-control @error('village') is-invalid @enderror"/>
                                    @error('village') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="street" class="form-control-label">Nama Jalan</label>
                                    <input type="text" name="street" value="{{ old('street') }}" class="form-control @error('street') is-invalid @enderror"/>
                                    @error('street') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_bank">Nama Bank</label>
                                    <select class="form-control" id="name_bank" name="name_bank">
                                        <option value="BRI">BRI</option>
                                        <option value="BNI">BNI</option>
                                        <option value="MANDIRI">Mandiri</option>
                                        <option value="BCA">BCA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_number" class="form-control-label">Nomor Rekening</label>
                                    <input type="number" name="account_number" value="{{ old('account_number') }}" class="form-control @error('account_number') is-invalid @enderror"/>
                                    @error('account_number') <div class="text-muted" required>{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Isi Alamat Lengkap Toko</label>
                                    <textarea name="address" style="height: 75px" placeholder="Contoh: Sp. 2 Umum, Jln. subakti, RT/RW 03/01 depan kantor camat"
                                            class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address') <div class="text-muted">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 information">
                                <strong>Penting:</strong>
                                <ul>
                                    <li>Mohon untuk mengisi formulir pembukaan toko dengan data yang valid.</li>
                                    <li>Nama pemilik rekening wajib sama dengan nama pemilik toko.</li>
                                    <li>Data anda akan di proses paling lama 2 hari pada jam kerja.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('dashboard-customer') }}" class="btn btn-danger btn-block">
                                    Batal
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Kirim Sekarang
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