@extends('layouts.member')
@section('title')
    Daftar Transaksi Saya
@endsection

@section('content')
<!-- Main content -->
    <section class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="title mb-3">
                                    <h3 class="mb-0 text-gray-800">Detail Produk ku</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="product-image">
                                    <figure class="figure">
                                        <img src="{{ Storage::url($transactions->product->galleries->first()->photo) }}" class="figure-img img-fluid rounded" alt="...">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                {{-- <div class="table-responsive"> --}}
                                    <table class="scroll-horizontal-vertical w-100">
                                        <tr>
                                            <div class="form-group">
                                                <th>ID Pesanan</th>
                                                <td class="text-end">{{ $invoice->order_id }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Kode Produk</th>
                                                <td class="text-end">{{ $transactions->product->code }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Nama Produk</th>
                                                <td class="text-end">{{ $transactions->product->name_product }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Harga</th>
                                                <td class="text-end">Rp.{{ number_format( $transactions->product->price) }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Jumlah Barang</th>
                                                <td class="text-end">{{ $transactions->quantity }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Ongkir</th>
                                                <td class="text-end">Rp.{{ number_format($transactions->product->ongkir_amount) }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Diskon</th>
                                                @if ($transactions->product->discount == true)
                                                    <td class="text-end">{{ $transactions->product->discount_amount }}</td>
                                                @else
                                                    <td class="text-end"> - </td>
                                                @endif
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Biaya Admin</th>
                                                <td class="text-end">Rp.{{ number_format($transactions->transaction->admin_fee) }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Kode Unik</th>
                                                <td class="text-end">{{ $transactions->transaction->code_unique }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Nomor Telephone</th>
                                                <td class="text-end">{{ $transactions->phone }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Nama Penerima</th>
                                                <td class="text-end">{{ $transactions->name }}</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <th>Total Pembayaran</th>
                                                <td class="text-end">Rp.{{ number_format($transactions->transaction->total_price + $transactions->transaction->code_unique + $transactions->transaction->admin_fee) }}</td>
                                            </div>
                                        </tr>
                                    </table>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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