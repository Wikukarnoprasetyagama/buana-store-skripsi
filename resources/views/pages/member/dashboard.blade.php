@extends('layouts.member')

@section('title')
    DASHBOARD {{ Auth::user()->roles }}
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
                        <th>Tanggal Pemesanan</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($orders as $order)
                          <tr>
                            <td>{{ $order->order_id }}</td>
                            <td class="font-weight-600">{{ $order->name }}</td>
                            @if ($order->payment_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $order->payment_status }}</div></td>
                            @elseif ($order->payment_status == 'SUCCESS')
                                <td><div class="badge badge-success">{{ $order->payment_status }}</div></td>
                            @elseif ($order->payment_status == 'FAILED')
                            <td><div class="badge badge-danger">{{ $order->payment_status }}</div></td>
                            @else
                            <td><div class="badge badge-info">{{ $order->payment_status }}</div></td>
                            @endif
                            <td>{{ $order->created_at->isoFormat('D MMMM Y') }}</td>
                            <td>
                              <a href="{{ route('transaction-customer.show', $order->id) }}" class="btn btn-primary" data-toggle="modal" data-target="#invoice">Detail</a>
                            </td>
                          </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

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
                        <th>Tanggal Pemesanan</th>
                        <th>Action</th>
                      </tr>
                      @foreach ($invoices as $invoice)
                          <tr>
                            <td>{{ $invoice->order_id }}</td>
                            <td class="font-weight-600">{{ $invoice->name }}</td>
                            @if ($invoice->payment_status == 'PENDING')
                            <td><div class="badge badge-warning">{{ $invoice->payment_status }}</div></td>
                            @elseif ($invoice->payment_status == 'SUCCESS')
                                <td><div class="badge badge-success">{{ $invoice->payment_status }}</div></td>
                            @elseif ($invoice->payment_status == 'FAILED')
                            <td><div class="badge badge-danger">{{ $invoice->payment_status }}</div></td>
                            @else
                            <td><div class="badge badge-info">{{ $invoice->payment_status }}</div></td>
                            @endif
                            <td>{{ $invoice->created_at->isoFormat('D MMMM Y') }}</td>
                            <td>
                              <a href="{{ route('transaction-customer.show', $invoice->id) }}" class="btn btn-primary" data-toggle="modal" data-target="#invoice">Detail</a>
                            </td>
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