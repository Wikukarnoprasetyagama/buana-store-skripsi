@extends('layouts.app')

@section('title')
    Detail Transaksi 
@endsection

@section('content')
<div class="main-content">
      <div class="container">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detail Transaksi Member</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-6 mb-3">
                            <figure class="figure gallery-container mb-3">
                                @if ($detail->product->galleries->count())
                                    <img src="{{ Storage::url($detail->product->galleries->first()->photo) }}" class="figure-img img-fluid rounded" alt="...">
                                @endif
                            </figure>
                        </div>
                        <div class="col-6 col-md-6">
                          <h5>Keterangan Transaksi</h5>
                          <div class="detail-customer mt-3">
                            <table class="information-transaction">
								<tr>
									<th width="70%">Nama</th>
									<td>{{ $detail->user->name }}</td>
								</tr>
								<tr>
									<th width="70%">Kode Produk</th>
									<td>{{ $detail->product->name_product }}</td>
								</tr>
								<tr>
									<th width="70%">Nama Barang</th>
									<td>{{ $detail->product->name_product }}</td>
								</tr>
								<tr>
									<th width="70%">Nama Toko</th>
									<td>{{ $detail->product->user->name_store }}</td>
								</tr>
								<tr>
									<th width="70%">Harga</th>
									<td>{{ $detail->product->price }}</td>
								</tr>
								<tr>
									<th width="70%">Jumlah</th>
									<td>{{ $detail->quantity }}</td>
								</tr>
								<tr>
									<th width="70%">Total Pembayaran</th>
									<td>{{ $detail->total_price }}</td>
								</tr>
								<tr>
									<th width="70%">Status Pembayaran</th>
									@if ($detail->payment_status == 'FAILED')
										<td class="text-danger"><strong>{{ $detail->payment_status }}</strong></td>
										@elseif ($detail->payment_status == 'PENDING')
										<td class="text-warning"><strong>{{ $detail->payment_status }}</strong></td>
										@elseif ($detail->payment_status == 'DIBAYAR')
										<td class="text-success"><strong>{{ $detail->payment_status }}</strong></td>
										@else
										<td class="text-info"><strong>{{ $detail->payment_status }}</strong></td>
									@endif
								</tr>
								<tr>
									<th width="70%">Status Pengiriman</th>
									@if ($detail->payment_status == 'FAILED')
									<td class="text-danger"><strong>DIBATALKAN</strong></td>
									@elseif ($detail->shipping_status == 'PENDING')
									<td class="text-warning"><strong>{{ $detail->shipping_status }}</strong></td>
									@elseif ($detail->shipping_status == 'DIKIRIM')
									<td class="text-info"><strong>{{ $detail->shipping_status }}</strong></td>
									@else
									<td class="text-success"><strong>{{ $detail->shipping_status }}</strong></td>
									@endif
								</tr>
                            </table>
							<div class="back-to-transaction mt-2">
								<a href="{{ route('transaction-member.index') }}" class="btn btn-secondary d-block">Kembali</a>
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