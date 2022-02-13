@extends('layouts.app')

@section('title')
    DATA TRANSAKSI SELLER
@endsection

@section('content')
    @if (count($item))
    <div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi SELLER</h1>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table table-hover scroll-horizontal-vertical w-100" id="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Nama Produk</th>
                                    <th>Total Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                    {{-- <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Aksi</th> --}}
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
                            <div class="no-data text-center">
                                <figure class="figure">
                                    <img src="{{ url('/images/ic_empty_data.svg') }}" class="img-fluid figure-img h-25 w-25" alt="">
                                </figure>
                                <div class="description">
                                    <h3>Belum ada Transaksi!</h3>
                                    Belum ada seller / customer yang melakukan transaksi.
                                </div>
                                <div class="add-slider mt-4">
                                    <a href="{{ route('dashboard-admin')}}" class="btn btn-success shadow-sm">
                                        <i class="fas fa-arrow fa-sm text-white-50"></i>
                                        Kembali Kedashboard
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
            {data: 'order_id', name: 'order_id'},
            {data: 'code_product', name: 'code_product'},
            {data: 'user.name', name: 'user.name'},
            {data: 'product.name_product', name: 'product.name_product'},
            {data: 'total_price', name: 'total_price'},
            {data: 'payment_status', name: 'payment_status'},
            // { 
            //     data: 'action',
            //     name: 'action',
            //     orderable: false,
            //     searcable: false,
            //     width: '15%' 
            // },
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