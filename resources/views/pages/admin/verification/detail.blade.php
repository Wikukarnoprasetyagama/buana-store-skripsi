@extends('layouts.app')
@section('title')
    Detail Member Verifikasi
@endsection

@section('content')
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
                    @foreach ($users as $user)
                        <div class="row">
                            <div class="d-none d-md-block col-md-3">
                                <figure class="figure d-block">
                                    <img src="{{ Storage::url($user->photo_profile) }}" class="img-thumbnail img-fluid figure-img w-100" alt="" style="height: 300px;">
                                </figure>
                            </div>
                            <div class="col-md-9">
                                <figure class="figure d-block">
                                    <img src="{{ Storage::url($user->photo_shop) }}" class="img-thumbnail img-fluid figure-img w-100" alt="" style="height: 300px;">
                                </figure>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_store" class="form-label">Nama Toko</label>
                                    <input type="text" name="name_store" class="form-control" value="{{ $user->name_store }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Nomor Telephon</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="village" class="form-label">Nama Desa</label>
                                    <input type="text" name="village" class="form-control" value="{{ $user->village }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="street" class="form-label">Nama Jalan</label>
                                    <input type="text" name="street" class="form-control" value="{{ $user->street }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}" disabled>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('verification.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row d-flex justify-content-right">
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <input type="hidden" name="roles" value="SELLER">
                                    <input type="hidden" name="status" value="TERVERIFIKASI">
                                    <button type="submit" class="btn btn-success change">Verifikasi Sekarang</button>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).on('click', '#hapus', function(){
    let url = $(this).data('url');
    let token = $(this).data('token')
    let id = $(this).data('id');
    let tr = this
    Swal.fire({ 
        title: 'Data ini akan di hapus',
        text: "Apakah anda yakin ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value)  {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        '_method': 'DELETE',
                        '_token': token,
                        'id': id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            response.success,
                            'success'
                        )
                        $(tr).closest('tr').remove();
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swal.fire(
                    'Dibatalkan!',
                    'Data yang ingin anda hapus berhasil dibatalkan',
                    'error'
                )
            }
            
        });
    });
</script>
@endpush