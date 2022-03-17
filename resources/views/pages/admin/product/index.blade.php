@extends('layouts.app')
@section('title')
    Daftar Produk
@endsection

@section('content')
@if (count($user))
{{-- <div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daftar Produk</h1>
                        <a href="{{ route('products-admin.create')}}" class="btn btn-success shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah Produk Baru
                        </a>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table table-hover scroll-horizontal-vertical w-100" id="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Produk</th>
                                    <th>Kategori</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
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
</div> --}}

<section class="main-content">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0 text-gray-800">Data Produk Seller Buana Store</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Nama Pemilik</th>
                                <th>Nama Toko</th>
                                <th>No. Hp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td style="padding-left: 24px">{{ $loop->iteration }}</td>
                                <td style="padding-left: 18px">
                                    {{ $user->email }}
                                </td>
                                <td style="padding-left: 18px">{{ $user->name }}</td>
                                <td style="padding-left: 18px">{{ $user->name_store }}</td>
                                <td style="padding-left: 18px">{{ $user->phone }}</td>
                                @if ($user->status == 'DIBLOKIR')
                                    <td style="padding-left: 18px"><strong class="text-danger">{{ $user->status }}</strong></td>
                                    @elseif ($user->status == 'PENDING')
                                    <td style="padding-left: 18px"><strong class="text-warning">{{ $user->status }}</strong></td>
                                    @else
                                    <td style="padding-left: 18px"><strong class="text-success">{{ $user->status }}</strong></td>
                                @endif
                                <td style="padding-left: 15px;">
                                    <div class="form-group d-flex">
                                        <a href="{{ route('products-admin.show', $user->id) }}" class="btn btn-sm btn-info mx-1" data-toggle="tooltip" data-placement="top" title="Lihat Produk"><i class="fas fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

@else

<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row py-5">
                        <div class="col-md-12">
                            <div class="no-data text-center">
                                <figure class="figure">
                                    <img src="{{ url('/images/ic_empty_data.svg') }}" class="img-fluid figure-img h-25 w-25" alt="">
                                </figure>
                                <div class="description">
                                    <h3>Belum ada Produk!</h3>
                                    silahkan untuk menambahkan data terlebih dahulu
                                </div>
                                <div class="add-slider mt-4">
                                    <a href="{{ route('products-admin.create')}}" class="btn btn-success shadow-sm">
                                        <i class="fas fa-plus fa-sm text-white-50"></i>
                                        Tambah Produk
                                    </a>
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
            {data: 'code', name: 'code'},
            {data: 'category.name_category', name: 'category.name_category'},
            {data: 'name_product', name: 'name_product'},
            {data: 'price', name: 'price'},
            {data: 'discount', name: 'discount'},
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