@extends('layouts.home')

@section('title')
    Keranjang Saya
@endsection

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
          <li class="breadcrumb-item active my-auto" aria-current="page">
            Keranjang
          </li>
        </ol>
      </div>
    </nav>

    <!-- Cart -->
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
                  <th scope="col">Harga</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $totalPrice = 0
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
                        @php
                            $quantity = 1;
                        @endphp
                        <button class="btn text-white btn-minus me-4" id="minusQuantity">
                          <i class="fas fa-minus"></i>
                        </button>
                        <input
                          type="number"
                          name="quantity"
                          value="{{ $quantity }}"
                          class="border-0 px-auto"
                          style="max-width: 40px"
                        />
                        <button class="btn text-white btn-plus" id="addQuantity">
                          <i class="fas fa-plus"></i>
                        </button>
                        </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group my-auto py-2" style="width: 130px">
                      <div class="price">Rp. {{ number_format($cart->product->price) }}</div>
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
                    $totalPrice + $cart->product->price *= $quantity
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
            <div class="row">
              <div class="col-12 col-md-4 mb-3">
                <label for="village" class="form-label">Nama Desa</label>
                <input
                  type="text"
                  class="form-control"
                  id="village"
                  placeholder="Tanah Tinggi"
                />
              </div>
              <div class="col-12 col-md-4 mb-3">
                <label for="street" class="form-label">Nama Jalan</label>
                <input
                  type="text"
                  class="form-control"
                  id="street"
                  placeholder="Purbaya"
                />
              </div>
              <div class="col-12 col-md-4 mb-3">
                <label for="name" class="form-label">Nama Penerima</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Wiku Karno"
                />
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-4">
                <label for="phone" class="form-label">Nomor Hp *aktif</label>
                <input
                  type="number"
                  class="form-control"
                  id="phone"
                  placeholder="087831247352"
                />
              </div>
              <div class="col-12 col-md-8">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <input
                  type="text"
                  class="form-control"
                  id="address"
                  placeholder="Rumah, kos / kontrakan, warna rumah, dll."
                />
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
                            @foreach ($carts as $cart)
                                <tr>
                                  <div class="form-group name-product bg-danger">
                                    <th width="100%">{{ $cart->product->name_product }}</th>
                                    <td width="50%" class="text-end">{{ number_format($cart->product->price) }}</td>
                                  </div>
                                </tr>
                            @endforeach
                            <tr>
                              <div class="form-group">
                                <th width="50%">Ongkos Kirim</th>
                                <td width="50%" class="text-end">7K</td>
                              </div>
                            </tr>
                            <tr>
                              <div class="form-group">
                                <th width="50%">Diskon</th>
                                <td width="50%" class="text-end">-</td>
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
                                    <strong>{{ number_format($totalPrice = $quantity + $cart->product->price) }}</strong>
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
                <div class="d-grid gap-2">
                  <a href="#" class="btn btn-cod" type="submit">Bayar Ditempat</a>
                  <button type="submit" class="btn btn-otomatis"
                    >Bayar Otomatis</
                  >
                </div>
                <div class="step-payment mt-2">
                  <a href="#">cara pembayaran otomatis?</a>
                </div>
              </div>
            </div>
        </form>
      </div>
    </section>
    <!-- End Address -->
@endsection

@push('after-script')
    <script>
      let btnAdd = document.querySelector('#addQuantity');
      let btnMinus = document.querySelector('#minusQuantity');
      let input = document.querySelector('input');

      
      btnAdd.addEventListener('click', () => {
        input.value = parseInt(input.value) + 1;
      });
      btnMinus.addEventListener('click', () => {
        input.value = parseInt(input.value) - 1;
      });
    </script>
@endpush