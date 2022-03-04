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
                    $totalPrice += $cart->product->price * $cart->quantity + $cart->product->ongkir_amount;
                @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- End Cart -->
    <!-- Address -->
    <section class="section-address">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3>Alamat Tujuan</h3>
          </div>
          <form action="{{ route('checkout') }}" class="mt-3" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="code_unique" value="{{ $code_unique }}">
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <input type="hidden" name="products_id" value="{{ $cart->products_id }}">
            <input type="hidden" name="code" value="{{ $cart->product->code }}">
            <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
            <div class="row">
              <div class="col-12 col-md-4 mb-3">
                <label for="village" class="form-label">Nama Kecamatan</label>
                <input type="text" name="district" class="form-control" value="Tapung Hilir" disabled>
              </div>
              <div class="col-12 col-md-4 mb-3">
                <label for="village" class="form-label">Nama Desa*</label>
                <input
                  type="text"
                  name="village"
                  class="form-control"
                  id="village"
                  required
                />
              </div>
              <div class="col-12 col-md-4 mb-3">
                <label for="street" class="form-label">Nama Jalan*</label>
                <input
                  type="text"
                  name="street"
                  class="form-control"
                  id="street"
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
                  required
                ></textarea>
              </div>
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
                                  <div class="form-group name-product bg-danger">
                                    <th width="100%">{{ $cart->product->name_product }}</th>
                                    <td width="50%" class="text-end">Rp.{{ number_format($cart->product->price * $cart->quantity) }}</td>
                                  </div>
                                </tr>
                                @php
                                    $totalPrice += $cart->product->price * $cart->quantity + $cart->product->ongkir_amount + $code_unique; 
                                @endphp
                            @endforeach
                            <tr>
                              <div class="form-group">
                                <th width="50%">Ongkos Kirim</th>
                                <td width="50%" class="text-end">Rp.{{ number_format($cart->product->ongkir_amount) }}</td>
                              </div>
                            </tr>
                            <tr>
                              <div class="form-group">
                                <th width="50%">Diskon</th>
                                <td width="50%" class="text-end">-</td>
                              </div>
                            </tr>
                            <tr>
                              <div class="form-group">
                                <th width="50%">Kode Unik</th>
                                <td width="50%" class="text-end text-success">{{ $code_unique }}</td>
                              </div>
                            </tr>
                          </table>
                          <hr />
                          <div class="subtotal">
                            <table>
                              <tr>
                                <div class="form-group">
                                  <th width="90%">Total</th>
                                  <td width="10%" class="text-end">
                                    <strong>Rp.{{ number_format($totalPrice ?? 0) }}</strong>
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
                <h3>Metode Pembayaran</h3>
                <div class="warning">
                  <p>
                    Nb: Harap pastikan barang yang anda pilih sudah sesuai, dan
                    alamat tujuan sudah benar.
                  </p>
                </div>
                <div class="d-grid gap-2 mt-5">
                  <button type="submit" class="btn btn-otomatis"
                    >Bayar Sekarang</
                  >
                </div>
                <div class="step-payment mt-2">
                  <a href="#">cara pembayaran?</a>
                </div>
              </div>
            </div>
        </form>
      </div>
    </section>
    <!-- End Address -->
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
                    Tidak ada member yang perlu di verifikasi
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