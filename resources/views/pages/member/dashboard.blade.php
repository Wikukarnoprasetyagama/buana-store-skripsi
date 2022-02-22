@extends('layouts.member')

@section('title')
    DASHBOARD {{ Auth::user()->roles }}
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
          <div class="row">
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
            @if (Auth::user()->roles == 'SELLER')
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Balance</h4>
                  </div>
                  <div class="card-body">
                    $187,13
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-box-open"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Product</h4>
                  </div>
                  <div class="card-body">
                    {{ $product }}
                  </div>
                </div>
              </div>
            </div>
            @else
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
                            <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
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
          @if (Auth::user()->roles == 'SELLER')
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Invoices</h4>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>Invoice ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Action</th>
                      </tr>
                      <tr>
                        <td><a href="#">INV-87239</a></td>
                        <td class="font-weight-600">Kusnadi</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 19, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-48574</a></td>
                        <td class="font-weight-600">Hasan Basri</td>
                        <td><div class="badge badge-success">Paid</div></td>
                        <td>July 21, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-76824</a></td>
                        <td class="font-weight-600">Muhamad Nuruzzaki</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 22, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-84990</a></td>
                        <td class="font-weight-600">Agung Ardiansyah</td>
                        <td><div class="badge badge-warning">Unpaid</div></td>
                        <td>July 22, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="#">INV-87320</a></td>
                        <td class="font-weight-600">Ardian Rahardiansyah</td>
                        <td><div class="badge badge-success">Paid</div></td>
                        <td>July 28, 2018</td>
                        <td>
                          <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </section>
      </div>

      <!-- Invoice -->
      {{-- <div class="modal fade" id="invoice" tabindex="-1" aria-labelledby="invoiceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="invoiceLabel">Detail Transaksi {{ $invoice->name }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  ...
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
        </div>
      </div> --}}
@endsection