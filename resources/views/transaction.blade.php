@extends('layouts.home')

@section('title')
    Transaksi
@endsection

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
          <li class="breadcrumb-item active my-auto" aria-current="page">
            Transaksi
          </li>
        </ol>
      </div>
    </nav>

    @if (count($transactions))
    <section class="section-cart">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 table-responsive">
					<table class="table table-borderless">
						<thead>
							<tr>
							<th scope="col">Foto Barang</th>
							<th scope="col">Nama &amp; Toko</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Total Harga</th>
							<th scope="col">Status Pembayaran</th>
							<th scope="col">Status Pengiriman</th>
							<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($transactions as $transaction)
							<tr>
								<th scope="row">
									<div class="form-group my-auto">
										@if ($transaction->product->galleries->count())
											<img
												src="{{ Storage::url($transaction->product->galleries->first()->photo) }}"
												class="img-fluid"
												alt="..."
											/>
										@endif
									</div>
								</th>
								<td>
									<div class="form-group my-auto py-1" style="width: 250px">
										<div class="title-product">
											{{ $transaction->product->name_product }}
										</div>
										<div class="name-store">{{ $transaction->product->user->name_store }}
											@if ($transaction->product->user->status == "DIBLOKIR")
												<a href="#" data-bs-toggle="modal" data-bs-target="#diblokirModal" style="text-decoration: none;"><strong class="text-danger">{{ $transaction->product->user->status }}</strong></a>
											@endif
										</div>
									</div>
									<!-- Modal DIBLOKIR -->
									<div class="modal fade" id="diblokirModal" tabindex="-1" aria-labelledby="diblokirModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="diblokirModalLabel">Akun Toko Ini Diblokir</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<p>
													Akun Toko {{ $transaction->product->user->name_store }} telah diblokir oleh admin, <br>
													Karena toko ini telah melanggar beberapa aturan kebijakan penggunaan. <br>
												</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
											</div>
											</div>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group my-auto py-1" style="width: 70px">
									<div class="quantity py-2">
										<span class="mx-4">{{ $transaction->quantity }}</span>
									</div>
									</div>
								</td>
								<td>
									<div class="form-group my-auto py-2" style="width: 130px">
										@if ($transaction->code_unique == true)
											{{-- <div class="price">Rp{{ number_format($transaction->total_price) }}</div> --}}
											<div class="price">Rp{{ number_format($transaction->total_price + $transaction->code_unique) }}</div>
											@elseif($transaction->code_unique == false)
											<div class="price">Rp{{ number_format($transaction->total_price) }}</div>
										@endif
									</div>
								</td>
								<td>
									<div class="form-group my-auto py-2" style="width: 130px">
									@if ($transaction->payment_status == 'PENDING')
										<div class="payment-status text-warning">{{ $transaction->payment_status }}</div>
										@elseif ($transaction->payment_status == 'DIBAYAR' )
										<div class="payment-status text-success">{{ $transaction->payment_status }}</div>
										@else
										<div class="payment-status text-info">{{ $transaction->payment_status }}</div>
									@endif
									</div>
								</td>
								<td>
									<div class="form-group my-auto py-2" style="width: 130px">
									@if ($transaction->shipping_status == 'PENDING')
										<div class="shipping-status text-warning">{{ $transaction->shipping_status }}</div>
										@elseif ($transaction->shipping_status == 'DIKIRIM' )
										<div class="shipping-status text-info">{{ $transaction->shipping_status }}</div>
										@else
										<div class="shippig-status text-success">{{ $transaction->shipping_status }}</div>
									@endif
									</div>
								</td>
								<td>
									@if ($transaction->payment_status == 'DIBAYAR')
										<div class="form-group my-auto py-1">
											<span class="badge bg-success"> selesai </span>
										</div>
										@else
										<div class="form-group my-auto py-1">
											<a href="{{ $transaction->midtrans_url }}" class="btn text-white btn-payment">Bayar</a>
										</div>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </section>
    @else

    <section class="section-empty-cart">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12 text-center">
            <div class="empty-cart text-center">
                <figure class="figure">
                    <img src="{{ url('/images/ic_empty_cart.svg') }}" class="img-fluid figure-img h-50 w-50" alt="">
                </figure>
                <div class="description mt-3">
                    <h1>Belum ada Transaksi!</h1>
                    Silahkan belanja terlebih dahulu.
                </div>
                <div class="add-slider mt-4">
                    <a href="{{ route('home')}}" class="btn btn-get-product btn-lg shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                        Belanja Sekarang
                    </a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
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