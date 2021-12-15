@extends('layouts.app')
@section('title')
    Daftar Permintaan Pembukaan Toko
@endsection

@section('content')

@if (count($item))
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4 pt-5">
                            <h1 class="h3 mb-0 text-gray-800">Daftar Permintaan Pembukaan Toko</h1>
                        </div>
                        <div class="table-responsive mt-5">
                            <table class="table table-hover scroll-horizontal-vertical w-100" id="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Pemilik</th>
                                        <th>Nama Toko</th>
                                        <th>Nama Desa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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
                                    <img src="{{ url('/frontend/images/empty.svg') }}" class="img-fluid figure-img h-25 w-25" alt="">
                                </figure>
                                <div class="description">
                                    <h3>Data tidak tersedia!</h3>
                                    Tidak ada member yang perlu di verifikasi
                                </div>
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
            {data: 'user.name', name: 'user.name'},
            {data: 'name_store', name: 'name_store'},
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