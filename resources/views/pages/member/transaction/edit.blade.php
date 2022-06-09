@extends('layouts.member')
@section('title')
    Edit Transaksi
@endsection

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between pt-3">
                        <h1 class="h3 mb-0 text-gray-800">Detail Transaksi {{ $transactions->name }}</h1>
                        <div class="status-pembayaran justify-content-right">
                            @if ($transactions->transaction->payment_status == 'MENUNGGU')
                                <strong class="badge badge-warning">Belum Bayar</strong>
                            @elseif ($transactions->transaction->payment_status == 'DIBAYAR')
                                <strong class="badge badge-success">Dibayar</strong>
                            @else
                            <strong class="badge badge-danger">Kadaluarsa</strong>
                            @endif
                        </div>
                    </div>
                    <div class="details-name">
                        <p>{{ $transactions->name_store }}</p>
                    </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Penerima</label>
                                    <input type="text" name="name" class="form-control" value="{{ $transactions->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name_product" class="form-label">Nama Produk</label>
                                    <input type="text" name="name_product" class="form-control" value="{{ $transactions->product->name_product }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Telephone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $transactions->phone }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input type="text" name="quantity" class="form-control" value="{{ $transactions->quantity }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="created_at" class="form-label">Tanggal Pembelian</label>
                                    <input type="text" name="created_at" class="form-control" value="{{ $transactions->transaction->created_at->isoFormat('D MMMM Y') }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_status" class="form-label">Status Pembayaran</label>
                                    <input type="text" name="payment_status" class="form-control" value="{{ $transactions->transaction->payment_status }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="text" name="price" class="form-control" value="Rp.{{ number_format($transactions->transaction->total_price) }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="districts" class="form-label">Nama Desa Penerima</label>
                                    <input type="text" name="village" class="form-control" value="{{ App\Models\Village::find($transactions->village)->name ?? '' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="street" class="form-label">Nama Jalan Penerima</label>
                                    <input type="text" name="street" class="form-control" value="{{ $transactions->street }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Alamat Lengkap Rumah Penerima</label>
                                    <input type="text" name="address" class="form-control" value="{{ $transactions->address }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping_status" class="form-label">Status Pengiriman</label>
                        </div>
                        <div class="d-flex">
                            @if ($transactions->transaction->shipping_status == 'DITERIMA')
                                <div class="status-pengiriman justify-content-left">
                                    <strong class="badge badge-success">Diterima</strong>
                                </div>
                            @else
                                <form class="mr-3" action="{{ route('transaction-seller.update', $transactions->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row d-flex justify-content-right">
                                    <div class="col-md-12 text-right">
                                        <div class="form-group">
                                            <input type="hidden" name="shipping_status" value="DIKIRIM">
                                            @if ($transactions->transaction->payment_status == "DIBAYAR")
                                                @if ($transactions->shipping_status == "DIKIRIM")
                                                    <button type="submit" class="btn btn-info" disabled>
                                                        <i class="fas fa-check"></i>
                                                        Sudah Dikirim
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-info d-block change">Dikirim</button>
                                                @endif
                                            @else
                                                <button type="submit" class="btn btn-info d-block change" disabled>Dikirim</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('transaction-seller.update', $transactions->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row d-flex justify-content-right">
                                    <div class="col-md-12 text-right">
                                        <div class="form-group">
                                            <input type="hidden" name="shipping_status" value="DITERIMA">
                                            @if ($transactions->transaction->payment_status == "DIBAYAR")
                                                <button type="submit" class="btn btn-success d-block change">Diterima</button>
                                            @else
                                                <button type="submit" class="btn btn-success d-block change" disabled>Diterima</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
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