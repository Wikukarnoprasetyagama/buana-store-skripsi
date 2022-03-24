@extends('layouts.home')

@section('title')
    Keranjang Saya
@endsection

@section('content')

    @if (count($carts))
        <!-- Cart -->
    <section class="section-cart product_data">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12 table-responsive">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">Foto Barang</th>
                  <th scope="col">Nama &amp; Toko</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody id="AppendCartItems">
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($carts as $cart)
                <tr>
                  <th scope="row">
                    <div class="form-group my-auto">
                      @if ($cart->product->galleries)
                        <img src="{{ Storage::url($cart->product->galleries->first()->photo) }}" class="img-fluid" alt="gambar produk" style="border-radius: 4px" />
                      @endif
                    </div>
                  </th>
                  <td>
                    <div class="form-group my-auto py-1" style="width: 250px">
                      <div class="title-product">
                        {{ $cart->product->name_product }}
                      </div>
                      <div class="name-store">{{ $cart->product->user->name_store }}</div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group my-auto py-1" style="width: 200px">
						<div class="quantity mt-1">
							<button class="btn text-white btn-minus qtyMinus me-4 changeQuantity" type="button" data-cartid="{{ $cart['id'] }}">
								<i class="fas fa-minus"></i>
							</button>
								<input
								type="number"
								name="quantity"
								value="{{ $cart->quantity }}"
								class="border-0 px-auto qty-input"
								style="max-width: 40px"
								disabled
								/>
							<button class="btn text-white btn-plus qtyPlus changeQuantity" type="button" data-cartid="{{ $cart['id'] }}">
							<i class="fas fa-plus"></i>
							</button>
                        </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group my-auto py-2" style="width: 130px">
                      <div class="price">Rp. {{ number_format($cart->product->price * $cart->quantity) }}</div>
                    </div>
                  </td>
                  <td>
                    <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                      @method('delete')
                      @csrf
                      <div class="form-group my-auto py-1">
                        <button type="submit" class="btn text-white btn-hapus">Hapus</button>
                      </div>
                    </form>
                  </td>
                </tr>
                @php
                    // $totalPrice += $cart->product->price * $cart->quantity + $cart->product->ongkir_amount;
                  $total = $cart->product->price * $cart->quantity + $cart->product->ongkir_amount; 
                  $discount = (($total * $cart->product->discount_amount) / 100);
                  $totalPrice = $total - $discount;
                @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- End Cart -->

    <!-- Notes Opsional -->
    <form action="{{ route('checkout') }}" class="mt-3" method="POST" enctype="multipart/form-data">
		@csrf
			<input type="hidden" name="code_unique" value="{{ $code_unique }}">
			<input type="hidden" name="total_price" value="{{ $totalPrice }}">
			<input type="hidden" name="products_id" value="{{ $cart->products_id }}">
			<input type="hidden" name="code" value="{{ $cart->product->code }}">
			<input type="hidden" name="quantity" value="{{ $cart->quantity }}">
			
			<!-- Notes Opsional -->
			{{-- <section class="section-notes mt-5">
				<div class="container">
					<div class="row">
					<div class="col-md-12">
						<h3>Catatan Barang</h3>
					</div>
					<div class="col-md-12">
						<label for="notes" class="form-label">Tambahkan catatan barang yang anda beli (Opsional)</label>
							<textarea
							type="text"
							name="notes"
							class="form-control"
							></textarea>
					</div>
					</div>
				</div>
			</section> --}}
    		<!-- End Notes Opsional -->
			<!-- Address -->
			<section class="section-address">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-12">
							<h3>Alamat Tujuan</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-4 mb-3">
							<label for="village" class="form-label">Nama Kecamatan</label>
							<input type="text" name="district" class="form-control" value="Tapung Hilir" disabled>
						</div>
						<div class="col-12 col-md-4 mb-3">
							<label for="village" class="form-control-label">Nama Desa</label>
							<div class="form-group mt-2">
								<select name="village" class="form-select">
									@foreach ($villages as $village)
										<option value="{{ $village->id }}">{{ $village->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4 mb-3">
							<label for="street" class="form-label">Nama Jalan*</label>
							<input
							type="text"
							name="street"
							class="form-control"
							id="street"
							oninvalid="this.setCustomValidity('kolom ini wajib di isi')" oninput="setCustomValidity('')"
							required
							/>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-3 mb-3">
							<label for="rtrw" class="form-label">RT / RW*</label>
							<input
							type="text"
							name="rtrw"
							class="form-control"
							id="rtrw"
							oninvalid="this.setCustomValidity('kolom ini wajib di isi')" oninput="setCustomValidity('')"
							required
							/>
						</div>
						<div class="col-12 col-md-3">
							<label for="phone" class="form-label">Nomor Hp *aktif</label>
							<input
							type="number"
							name="phone"
							class="form-control"
							id="phone"
							oninvalid="this.setCustomValidity('kolom ini wajib di isi')" oninput="setCustomValidity('')"
							required
							/>
						</div>
						<div class="col-12 col-md-6">
							<label for="name" class="form-label">Nama Penerima*</label>
							<input
							type="text"
							name="name"
							class="form-control"
							id="name"
							oninvalid="this.setCustomValidity('kolom ini wajib di isi')" oninput="setCustomValidity('')"
							required
							/>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<label for="address" class="form-label">Alamat Lengkap*</label>
							<textarea
							type="text"
							name="address"
							class="form-control"
							id="address"
							placeholder="Rumah, kos / kontrakan, warna rumah, dll."
							oninvalid="this.setCustomValidity('kolom ini wajib di isi')" oninput="setCustomValidity('')"
							required
							></textarea>
						</div>
					</div>
					<div class="row section-detail-price">
						<div class="col-12 col-md-6">
							<h3>Rincian Harga</h3>
							<div class="row">
							<div class="col-12 col-md-10 mb-5">
								<div class="detail-price">
								<div class="card">
									<div class="card-body">
										<table>
											@php
												$totalPrice = 0;
											@endphp
											@foreach ($carts as $cart)
												<tr>
												<div class="form-group name-product">
													<th width="100%">{{ $cart->product->name_product }}</th>
													<td width="50%" class="text-end">Rp.{{ number_format($cart->product->price * $cart->quantity) }}</td>
												</div>
												</tr>
												@php
													// $total = $cart->product->price; 
													// $discount = (($cart->product->price * $cart->quantity * $cart->product->discount_amount) / 100);
													// $discount = (($total * $cart->product->discount_amount) / 100);
													// $totalPrice = $total - $discount + $code_unique;
													// if ($cart->product->discount == true) {
													// 	$totalPrice = $total - $discount + $cart->product->ongkir_amount + $code_unique;
													// }elseif ($cart->product->discount == 0) {
													// 	$totalPrice = $total + $code_unique + $cart->product->ongkir_amount * $cart->quantity;
													// }elseif ($cart->product->ongkir == 0) {
													// 	$totalPrice = $total + $code_unique;
													// }
													$admin_fee = 5000;
													$total += $cart->product->price * $cart->quantity;
													// $totalPrice += $total + $cart->product->ongkir_amount + $admin_fee;
													$discount = (($total * $cart->product->discount_amount) / 100);
													$totalPrice = $total - $discount + $code_unique;
													if ($cart->product->discount == true && $cart->product->ongkir == 0) {
														$totalPrice = $total - $discount  + $admin_fee;
													}elseif($cart->product->discount == true && $cart->product->ongkir == true){
														$totalPrice = $total - $discount + $cart->product->ongkir_amount + $admin_fee;
													}
												@endphp
											@endforeach
											<tr>
											<div class="form-group">
												<th width="50%">Ongkos Kirim</th>
												@if ($cart->product->ongkir == true)
													<td width="50%" class="text-end">Rp.{{ number_format($cart->product->ongkir_amount) }}</td>
													@else
													<td width="50%" class="text-end text-info">Gratis</td>
												@endif
											</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="50%">Biaya Admin</th>
														<td width="50%" class="text-end" aria-valuetext="5000">Rp.5000</td>
												</div>
											</tr>
											<tr>
											<div class="form-group">
												<th width="50%">Diskon</th>
												<td width="50%" class="text-end"><strong class="text-warning">{{ $fee }}%</strong></td>
											</div>
											</tr>
											<tr>
											<div class="form-group">
												<th width="50%">Kode Unik</th>
												{{-- @if ($discount == true)
												<td width="50%" class="text-end"><strong class="text-success"> - </strong></td>
												@elseif ($discount == true || $discount == 0)
												<td width="50%" class="text-end"><strong class="text-success">{{ $code_unique }}</strong></td>
												@endif --}}
												<td width="50%" class="text-end"><strong class="text-success">{{ $code_unique }}</strong></td>
											</div>
											</tr>
										</table>
										<hr />
										<div class="subtotal">
											<table>
											<tr>
												<div class="form-group">
												<th width="90%"><b>Total Pembayaran</b></th>
												<td width="10%" class="text-end">
													<strong>Rp.{{ number_format($totalPrice + $code_unique ?? 0) }}</strong>
												</td>
												</div>
											</tr>
											</table>
										</div>
									</div>
								</div>
								</div>
							</div>
							</div>
						</div>
						<div class="col-12 col-md-6 payment-method">
							<h3>Pembayaran</h3>
							<div class="warning">
							<p>
								Nb: Harap pastikan barang yang anda pilih sudah sesuai, dan
								alamat tujuan sudah benar.
							</p>
							</div>
							<div class="d-grid gap-2 mt-5">
								<button type="submit" class="btn btn-otomatis">Checkout Barang Sekarang</button>
							</div>
							<div class="step-payment mt-2">
								<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">cara pembayaran?</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Address -->
	</form>
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
                    <h3>Belum ada Produk dikeranjang!</h3>
                    Keranjangmu masih kosong nih, yuk belanja sekarang!
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cara Melakukan Pembayaran!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul>
              <li>Setelah klik bayar sekarang, maka slip pembayaran kamu akan langsung dibuat.</li>
              <li>Jika pembayaran telah dibuat, kamu bisa langsung menuju kehalaman transaksi.</li>
              <li>Pembayaran dapat dilakukan melalui transfer bank atau Indomaret</li>
              <li>Pembayaran akan berakhir dalam 1x24 jam.</li>
              <li>Selamat belanja!</li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('after-style')
    <style>
      .section-empty-cart{
        margin-top: 60px;
      }

      h3{
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
	  .btn-otomatis{
		background: #a43ce3;
		color: #fff;
	  }
    </style>
@endpush

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).on('click', '.changeQuantity', function(){
		if($(this).hasClass('qtyMinus')){
			const quantity = $(this).next().val();
			if (quantity <= 1) {
				Swal.fire(
					'Mohon maaf!',
					'Jumlah barang minimal 1 atau lebih!',
					'warning'
				);
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