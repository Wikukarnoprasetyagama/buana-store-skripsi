@extends('layouts.member')
@section('title')
    Update Profile
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4 pt-5">
                        <h1 class="h3 mb-0 text-gray-800">Edit Profile Saya</h1>
                    </div>
                    <form action="{{ route('profile-customer.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input name="name" class="form-control" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="phone" class="form-label">Nomor Hp / Wa</label>
                                            <input name="phone" class="form-control" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provinces_id" class="form-label">Provinsi</label>
                                            <select name="provinces_id" class="form-control">
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regencies_id" class="form-label">Kabupaten</label>
                                            <select name="regencies_id" class="form-control">
                                                @foreach ($regencies as $regencie)
                                                    <option value="{{ $regencie->id }}">{{ $regencie->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="districts_id" class="form-label">Kecamatan</label>
                                            <select name="districts_id" class="form-control">
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea name="address" class="form-control text-left" style="height: 120px"> {{ $user->address }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="{{ route('profile-customer.index') }}" class="btn btn-secondary d-block text-dark">Kembali</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Update Profile</button>
                                        </div>
                                    </div>
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