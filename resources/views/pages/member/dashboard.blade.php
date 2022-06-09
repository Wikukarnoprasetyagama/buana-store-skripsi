@extends('layouts.member')

@section('title')
    Dashboard - {{ Auth::user()->roles }} - {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="row">
            @if (Auth::user()->roles == 'SELLER')
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-box-open"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Product</h4>
                    </div>
                    <div class="card-body">
                      {{ $product }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                      Rp.{{ number_format($revenue) }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Pendapatan</h4>
                    </div>
                    <div class="card-body">
                      Rp.{{ number_format($profit) }}
                    </div>
                  </div>
                </div>
              </div>
            @else
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-cart-plus"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Keranjang</h4>
                  </div>
                  <div class="card-body">
                    {{ $cart }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Transaksi</h4>
                  </div>
                  <div class="card-body">
                    {{ $transaction }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Pengeluaran</h4>
                  </div>
                  <div class="card-body">
                    Rp.{{ number_format($revenue) }}
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>

          @if (Auth::user()->roles == 'SELLER')
          {{-- Invoice Penjualan --}}
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Invoices Penjualan Produk</h4>
                  <div class="card-header-action">
                    <a href="{{ route('transaction-seller.index') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>ID Pesanan</th>
                        <th>Nama</th>
                        <th>Status Pembayaran</th>
                        <th>Status Pengiriman</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Action</th>
                      </tr>
                      @forelse ($orders as $order)
                          <tr>
                            <td>{{ $order->transaction->order_id }}</td>
                            <td class="font-weight-600">{{ $order->name }}</td>
                            @if ($order->transaction->payment_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $order->transaction->payment_status }}</div></td>
                            @elseif ($order->transaction->payment_status == 'DIBAYAR')
                                <td><div class="badge badge-success">{{ $order->transaction->payment_status }}</div></td>
                            @elseif ($order->transaction->payment_status == 'KADALUARSA')
                            <td><div class="badge badge-danger">{{ $order->transaction->payment_status }}</div></td>
                            @else
                            <td><div class="badge badge-info">{{ $order->transaction->payment_status }}</div></td>
                            @endif
                            @if ($order->transaction->payment_status == 'FAILED')
                            <td><div class="badge badge-danger">BATAL</div></td>
                            @elseif ($order->shipping_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $order->shipping_status }}</div></td>
                            @elseif ($order->shipping_status == 'DIKIRIM')
                                <td><div class="badge badge-info">{{ $order->shipping_status }}</div></td>
                            @else
                            <td><div class="badge badge-success">{{ $order->shipping_status }}</div></td>
                            @endif
                            <td>{{ $order->created_at->isoFormat('D MMMM Y') }}</td>
                            @if ($order->products_id == true)
                                <td>
                                  <a href="{{ route('transaction-seller.edit', $order->id) }}" class="btn btn-primary">Detail</a>
                                </td>
                            @else
                            <td>
                              <a href="{{ route('transaction-seller.edit', $order->id) }}" class="btn btn-primary">Detail</a>
                            </td>
                            @endif
                          </tr>

                      @empty
                          <tr>
                            <td colspan="6" class="text-center">Tidak ada data!</td>
                          </tr>
                      @endforelse
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Invoice Pembelian --}}
          @if (count($invoices))
              <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Invoices Pembelian Produk</h4>
                  <div class="card-header-action">
                    <a href="{{ route('transaction-seller.index') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>ID Pesanan</th>
                        <th>Nama</th>
                        <th>Status Pembayaran</th>
                        <th>Status Pengiriman</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Action</th>
                      </tr>
                      @forelse ($invoices as $invoice)
                          <tr>
                            <td>{{ $invoice->transaction->order_id }}</td>
                            <td class="font-weight-600">{{ $invoice->name }}</td>
                            @if ($invoice->transaction->payment_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $invoice->transaction->payment_status }}</div></td>
                            @elseif ($invoice->transaction->payment_status == 'DIBAYAR')
                                <td><div class="badge badge-success">{{ $invoice->transaction->payment_status }}</div></td>
                            @elseif ($invoice->transaction->payment_status == 'KADALUARSA')
                            <td><div class="badge badge-danger">{{ $invoice->transaction->payment_status }}</div></td>
                            @elseif ($invoice->transaction->payment_status == 'MENUNGGU')
                            <td><div class="badge badge-info">{{ $invoice->transaction->payment_status }}</div></td>
                            @endif
                            @if ($invoice->transaction->payment_status == 'FAILED')
                            <td><div class="badge badge-danger">BATAL</div></td>
                            @elseif ($invoice->shipping_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $invoice->shipping_status }}</div></td>
                            @elseif ($invoice->shipping_status == 'DIKIRIM')
                                <td><div class="badge badge-info">{{ $invoice->shipping_status }}</div></td>
                            @else
                            <td><div class="badge badge-success">{{ $invoice->shipping_status }}</div></td>
                            @endif
                            <td>{{ $invoice->created_at->isoFormat('D MMMM Y') }}</td>
                            <td>
                              <a href="{{ route('transaction-seller.show', $invoice->transaction->id) }}" class="btn btn-primary">Detail</a>
                            </td>
                            @if ($invoice->transaction->payment_status == 'MENUNGGU')
                                <td>
                                  <a href="{{ $invoice->transaction->midtrans_url }}" class="btn btn-success">Bayar</a>
                                </td>                                
                            @endif
                          </tr>

                      @empty
                          <tr>
                            <td colspan="6" class="text-center">Tidak ada data!</td>
                          </tr>
                      @endforelse
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif

          @else

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Invoices</h4>
                  <div class="card-header-action">
                    <a href="{{ route('transaction-customer.index') }}" class="btn btn-danger">Selengkapnya <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>ID Pesanan</th>
                        <th>Nama</th>
                        <th>Status Pembayaran</th>
                        <th>Status Pegiriman</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($invoices as $invoice)
                          <tr>
                            <td>{{ $invoice->transaction->order_id }}</td>
                            <td class="font-weight-600">{{ $invoice->name }}</td>
                            @if ($invoice->transaction->payment_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $invoice->transaction->payment_status }}</div></td>
                            @elseif ($invoice->transaction->payment_status == 'DIBAYAR')
                                <td><div class="badge badge-success">{{ $invoice->transaction->payment_status }}</div></td>
                            @elseif ($invoice->transaction->payment_status == 'KADALUARSA')
                            <td><div class="badge badge-danger">{{ $invoice->transaction->payment_status }}</div></td>
                            @else
                            <td>
                                <div class="badge badge-info">
                                  {{ $invoice->transaction->payment_status }}
                                </div>
                            </td>
                            @endif
                            @if ($invoice->shipping_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $invoice->shipping_status }}</div></td>
                            @elseif ($invoice->shipping_status == 'DIKIRIM')
                                <td><div class="badge badge-info">{{ $invoice->shipping_status }}</div></td>
                            @else
                            <td><div class="badge badge-success">{{ $invoice->shipping_status }}</div></td>
                            @endif
                            <td>{{ $invoice->created_at->isoFormat('D MMMM Y') }}</td>
                            <td>
                              <a href="{{ route('transaction-customer.show', $invoice->id) }}" class="btn btn-primary">Detail</a>
                            </td>
                            @if ($invoice->transaction->payment_status == 'MENUNGGU')
                                <td>
                                  <a href="{{ $invoice->transaction->midtrans_url }}" class="btn btn-success" target="_blank">Bayar</a>
                                </td>                                
                            @endif
                          </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </section>
      </div>
@endsection