@extends('layouts.app')
@section('title')
    Daftar Transaksi
@endsection

@section('content')
{{-- <div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi</h1>
                        <a href="{{ route('pdf-transaction')}}" class="btn btn-success shadow-sm">
                            <i class="fas fa-print fa-sm text-white-50"></i>
                            Cetak Transaksi
                        </a>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table table-hover scroll-horizontal-vertical w-100" id="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Customer</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Status Pembayaran</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Total</th>
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

@if (count($transactions))
<section class="main-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="title my-2">
                            <h3 class="mb-0 text-gray-800">Data Transaksi Penjualan</h3>
                        </div>
                        <div class="print my-2">
                            <a href="{{ route('pdf-transaction')}}" class="btn btn-success shadow-sm">
                                <i class="fas fa-print fa-sm text-white-50"></i>
                                Cetak Transaksi
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-hover scroll-horizontal-vertical w-100">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Transaksi</th>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Nama Produk</th>
                                    <th>No. Hp</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td style="padding-left: 30px">{{ $loop->iteration }}</td>
                                            <td style="padding-left: 25px">{{ $transaction->transaction->order_id }}</td>
                                            <td style="padding-left: 25px">{{ $transaction->code_product }}</td>
                                            <td style="padding-left: 25px">{{ $transaction->name }}</td>
                                            <td style="padding-left: 25px">{{ $transaction->product->name_product }}</td>
                                            @if ($transaction->phone != null)
                                            <td style="padding-left: 18px">{{ $transaction->phone }}</td>
                                            @else
                                            <td class="text-center" style="padding-left: 18px"> - </td>
                                            @endif
                                            <td style="padding-left: 5px" class="text-center">{{ $transaction->quantity }}</td>
                                            <td style="padding-left: 18px">{{ $transaction->created_at->isoFormat('D MMMM Y') }}</td>
                                            @if ($transaction->transaction->payment_status == 'FAILED')
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-danger">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @elseif ($transaction->transaction->payment_status == 'PENDING')
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-warning">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @elseif ($transaction->transaction->payment_status == 'DIBAYAR')
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-success">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @else
                                            <td style="padding-left: 18px"><strong class="text-white badge badge-info">{{ $transaction->transaction->payment_status }}</strong></td>
                                            @endif
                                            <td style="padding-left: 25px">{{ $transaction->transaction->total_price }}</td>
                                            <td style="padding-left: 25px">
                                                <a href="{{ route('transaction-member.show', $transaction->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
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

        @else

        <div class="row">
            <div class="col-md-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{ url('/images/ic_empty_cart.svg') }}" class="img-fluid figure-img h-50 w-50" alt="">
                        </figure>
                        <div class="description mt-3">
                            <h3>Belum ada Transaksi!</h3>
                            Belum ada member yang melakukan transaksi.
                        </div>
                        <div class="back-to-dashboard mt-4">
                            <a href="{{ route('dashboard-admin')}}" class="btn btn-success btn-lg shadow-sm">
                                <i class="fas fa-plus fa-sm text-white-50"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
            {data: 'code_product', name: 'code_product'},
            {data: 'product.name_product', name: 'product.name_product'},
            {data: 'payment_status', name: 'payment_status'},
            {data: 'quantity', name: 'quantity'},
            {data: 'total_price', name: 'total_price'},
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