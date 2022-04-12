@extends('layouts.blank')

@section('title')
    Transaksi - {{ Auth::user()->name }}
@endsection

@section('content')

<section class="section-transaction mt-3">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-12 col-md-8">
					<div class="card">
						<div class="card-header text-center">
							<figure class="figure">
								<img src="{{ url('/images/logo.svg') }}" alt="">
							</figure>
							<h3 class="card-title">Detail Transaksi Pembelian</h3>
							<span>An. {{ Auth::user()->name }}</span>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								@php
									$totalPrice = 0;
								@endphp
								@foreach ($transactions as $transaction)
								<table class="scroll-horizontal-vertical w-100">
									<tr>
										<div class="form-group">
											<th>ID Pesanan</th>
											<td class="text-end">{{ $transaction->transaction->order_id }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Kode Produk</th>
											<td class="text-end">{{ $transaction->product->code }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Harga</th>
											<td class="text-end">Rp.{{ number_format($transaction->product->price) }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Nama Barang</th>
											<td class="text-end">{{ $transaction->product->name_product }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>No Hp</th>
											<td class="text-end">{{ $transaction->phone }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Nama Penerima</th>
											<td class="text-end">{{ $transaction->name }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Jumlah Pesanan</th>
											<td class="text-end">{{ $transaction->quantity }}</td>
										</div>
									</tr>
								</table>
								<hr />
								@endforeach
							</div>
							<div class="code-bstore table-responsive">
								<table class="scroll-horizontal-vertical w-100">
									<tr>
										<div class="form-group">
											<th>Ongkir</th>
											@if ($transaction->transaction->ongkir == true)
												<td class="text-end">Rp.{{ number_format($ongkir) }}</td>
											@else
												<td class="text-end text-primary">Gratis</td>
											@endif
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Biaya Admin</th>
											<td class="text-end">Rp.{{ number_format($transaction->transaction->admin_fee) }}</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Diskon</th>
											<td class="text-end">{{ $transaction->product->discount_amount }}%</td>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th>Kode Unik</th>
											<td class="text-end">{{ $transaction->transaction->code_unique }}</td>
										</div>
									</tr>
								</table>
							</div>
							<hr />
							<div class="subtotal table-responsive">
								<table class="scroll-horizontal-vertical w-100">
									<tr>
										<div class="form-group">
											<th><b>Total Pembayaran</b></th>
											<td class="text-end"><strong class="text-success">Rp.{{ number_format($transaction->transaction->total_price + $transaction->transaction->admin_fee + $transaction->transaction->code_unique - $transaction->transaction->discount_amount ?? 0) }}</strong></td>
										</div>
									</tr>
								</table>
							</div>
							<div class="row mt-3">
								<div class="col-12 col-md-6 d-block mb-2">
									<a href="{{ route('transaction') }}" class="btn btn-letter d-block">Nanti Saja</a>
								</div>
								<div class="col-12 col-md-6 d-block mb-2">
									<a href="{{ $transaction->transaction->midtrans_url }}" class="btn btn-payment d-block">Bayar Sekarang</a>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('after-style')
    <style>
      .section-empty-cart{
        margin-top: 60px;
      }

	.badge{
		  font-size: 16px;
		  font-weight: 400;
	  }

      h1{
          font-size: 32px;
          font-family: "Merriweather";
          font-weight: 600;
          color: #1e124c;
      }
      .description{
        color: #525252;
        font-size: 16px;
        font-weight: 400;
      }
      .btn-get-product{
        background: #a43ce3;
        border-radius: 25px;
        color: #fff;
        font-size: 16px;
      }
      .btn-get-product:hover{
        background: #882ec0;
        color: #fff;
      }

      .btn-payout{
        background: #a43ce3;
        border-radius: 25px;
        color: #fff;
        font-size: 16px;
      }
      .btn-payout:hover{
        background: #882ec0;
        color: #fff;
      }
	  .btn-letter{
		background: #9e9e9e;
		border-radius: 25px;
		color: #fff;
		font-size: 16px;
	  }
	  .btn-letter:hover{
        background: #929292;
        color: #fff;
      }
    </style>
@endpush

@push('after-script')
<script>
	$(document).on('click', '.changeQuantity', function(){
		if($(this).hasClass('qtyMinus')){
			const quantity = $(this).next().val();
			if (quantity <= 1) {
				alert("Quantity must be 1 or greater!");
				return false;
			}else{
				new_qty = parseInt(quantity)-1;
			}
		}
		if($(this).hasClass('qtyPlus')){
			const quantity = $(this).prev().val();
			new_qty = parseInt(quantity)+1;
		}
		const cartid = $(this).data('cartid');
		$.ajax({
			
			type: "post",
			url: "/keranjang",
			data: {
				"_token": "{{ csrf_token() }}",
				"cartid":cartid,
				"qty":new_qty
			},
			dataType: "json",
			success: function (response) {
				window.location.reload();
				$("#AppendCartItems");
			},error:function(){
				alert("error");
			}
		});
	});
</script>
@endpush