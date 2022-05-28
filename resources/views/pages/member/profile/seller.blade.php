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
                        
                        {{-- photo profile --}}
                        <div class="col-12 col-md-2 text-center">
                            <form action="{{ route('profile-seller-upload', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Nama</label>
                                        <input type="email" class="form-control" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Nama Toko</label>
                                        <input type="text" class="form-control" value="{{ $user->name_store }}" disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="provinces_id" class="form-label">Provinsi</label>
                                            <input type="text" name="provinces_id" class="form-control" 
                                            value="{{ App\Models\Province::find($user->provinces_id)->name ?? '' }}" 
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="regencies_id" class="form-label">Kabupaten</label>
                                        <input type="text" name="regencies_id" class="form-control" 
                                        value="{{ App\Models\Regency::find($user->regencies_id)->name ?? '' }}" 
                                        disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="districts_id" class="form-label">Kecamatan</label>
                                        <input name="districts_id" class="form-control text-left" 
                                        value="{{ App\Models\District::find($user->districts_id)->name ?? '' }}" 
                                        disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Nomor Telephone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" disabled>
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
                                        <a href="{{ route('dashboard-seller') }}" class="btn btn-secondary d-block text-dark">Kembali</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="{{ route('profile-seller.edit', $user->id) }}" class="btn btn-primary d-block">Edit Profile</a>
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