@extends('layouts.detail')

@section('title', 'Alamat & Pembayaran')

@section('content')
    <nav aria-label="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
          <li class="breadcrumb-item"><a href="{{ route('cart') }}">Keranjang</a></li>
          <li class="breadcrumb-item active my-auto" aria-current="page">
            Pembayaran
          </li>
        </ol>
      </div>
    </nav>

    <!-- Address -->
    <section class="section-address">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3>Alamat Tujuan</h3>
          </div>
          <form action="{{ route('checkout') }}" class="mt-3" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
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
                              @php
                                  $totalPrice = 0;
                              @endphp
                            @foreach ($carts as $cart)
                                <tr>
                                  <div class="form-group name-product bg-danger">
                                    <th width="100%">{{ $cart->product->name_product }}</th>
                                    <td width="50%" class="text-end">{{ number_format($cart->product->price * $cart->quantity) }}</td>
                                  </div>
                                </tr>
                                @php
                                    $totalPrice += $cart->product->price * $cart->quantity
                                @endphp
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
    