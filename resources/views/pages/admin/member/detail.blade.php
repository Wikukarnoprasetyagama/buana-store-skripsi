@extends('layouts.app')
@section('title')
    Detail Member - {{ $user->name }}
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4 pt-3">
                        <h1 class="h3 mb-0 text-gray-800">Data Profile</h1>
                        <span class="badge badge-info">{{ $user->name }}</span>
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
                                        <label for="name_store" class="form-label">Nama Toko</label>
                                        <input type="text" class="form-control" value="{{ $user->name_store }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name_store" class="form-label">Nama Pemilik</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" disabled>
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
                                        <label for="phone" class="form-label">Nomor Hp</label>
                                        <input type="text" class="form-control" value="{{ $user->phone }}" disabled>
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
                                    <div class="col-md-4">
                                        <label for="street" class="form-label">Nama Jalan</label>
                                        <input name="street" class="form-control text-left" value="{{ $user->street }}" disabled>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input name="address" class="form-control text-left" value="{{ $user->address }}" disabled>
                                    </div>
                                </div>
                            <div class="row mt-5">
                                @if ($user->roles == 'SELLER')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="{{ route('dashboard-admin') }}" class="btn btn-secondary d-block text-dark">Kembali</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="{{ route('products-admin.show', $user->id) }}" class="btn btn-primary d-block">Edit Profile</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a href="{{ route('dashboard-admin') }}" class="btn btn-secondary d-block text-dark">Kembali</a>
                                        </div>
                                    </div>
                                @endif
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
    var datatable =  $('#table').DataTable({
        processing: true,
        serverSide:true,
        ordering:true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns:[
            {data: 'id', name: 'id'},
            {data: 'photo', name: 'photo'},
            {data: 'roles', name: 'roles'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'status', name: 'status'},
            { 
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%' 
            },
        ]
    })
</script>
<script>
    $(document).on('click', '#hapus', function(){
    let url = $(this).data('url');
    let token = $(this).data('token')
    let id = $(this).data('id');
    let tr = this
    Swal.fire({ 
        title: 'Apakah anda yakin ?',
        text: "Data ini akan dihapus",
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
                    'Hapus data dibatalkan!',
                    'Data yang ingin anda hapus telah dibatalkan',
                    'error'
                )
            }
            
        });
    });
</script>
@endpush