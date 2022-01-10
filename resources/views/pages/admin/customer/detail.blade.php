@extends('layouts.app')
@section('title')
    Detail Customer {{ $detail->name }}
@endsection

@section('content')
    <div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4 pt-3">
                        <h1 class="h3 mb-0 text-gray-800">Detail Customer <strong class="ml-3" style="font-size: 16px">{{ $detail->name }}</strong></h1>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            @if ($detail->photo_profile == true)
                            <figure class="figure">
                                <img src="{{ Storage::url($detail->photo_profile) }}" class="figure-img img-fluid" alt="" style="border-radius: 8px" />
                            </figure>
                            @else
                            <figure class="figure d-flex justify-content-center">
                                <img src="{{ url('/images/ic_avatar.svg') }}" class="figure-img img-fluid align-items-center" alt="" />
                            </figure>
                            @endif
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control" value="{{ $detail->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ $detail->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status Masuk / Daftar</label>
                                        @if ($detail->remember_token == true)
                                            <input type="text" class="form-control" value="GOOGLE" disabled>
                                            @else
                                            <input type="text" class="form-control" value="MANUAL" disabled>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pendaftaran</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($detail->created_at)->format('d/m/Y') }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Hp</label>
                                        <input type="text" class="form-control" value="{{ $detail->phone }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Desa</label>
                                            <input type="text" class="form-control" value="{{ $detail->village }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Nama Jalan</label>
                                    <input class="form-control text-left" value="{{ $detail->street }}" disabled>
                                </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <input class="form-control text-left" value="{{ $detail->address }}" disabled>
                                    </div>
                                </div>
                            <div class="row mt-5">
                                <div class="col-md-12 text-right">
                                    <div class="form-group">
                                        <a href="{{ route('customer.index') }}" class="btn btn-primary">Kembali</a>
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
    var datatable =  $('#table').DataTable({
        processing: true,
        serverSide:true,
        ordering:true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns:[
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'status', name: 'status'},
            {data: 'village', name: 'village'},
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