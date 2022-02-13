@extends('layouts.app')

@section('title')
    DATA TRANSAKSI MEMBER
@endsection

@section('content')
    <!-- Main content -->
    <section class="main-content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0 text-gray-800">Data Transaksi Member</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID Order</th>
                    <th>Kode Produk</th>
                    <th>Nama Barang</th>
                    <th>Nama Pembeli</th>
                    <th>Total Harga</th>
                    <th>Status Pembayaran</th>
                  </tr>
                  </thead>
                  <tbody>
                      @php
                            $no = 1;
                      @endphp
                      @foreach ($transactions as $transaction)
                        <tr>
                            <td style="padding-left: 24px">{{ $no++ }}</td>
                            <td style="padding-left: 18px">{{ $transaction->order_id }}</td>
                            <td style="padding-left: 18px">{{ $transaction->code_product }}</td>
                            <td style="padding-left: 18px">{{ $transaction->product->name_product }}</td>
                            <td style="padding-left: 18px">{{ $transaction->user->name }}</td>
                            <td style="padding-left: 18px">{{ $transaction->total_price }}</td>
                            @if ($transaction->payment_status == 'Dibayar')
                                <td style="padding-left: 15px"><span class="badge badge-success">{{ $transaction->payment_status }}</span></td>
                            @elseif ($transaction->payment_status == 'Menunggu')
                                <td style="padding-left: 15px" class="text-white"><span class="badge badge-warning">{{ $transaction->payment_status }}</span></td>
                            @else
                                <td style="padding-left: 15px"><span class="badge badge-danger">{{ $transaction->payment_status }}</span></td>
                            @endif
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </section>
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).on('click', '#hapus', function(){
    let url = $(this).data('url');
    let token = $(this).data('token')
    let id = $(this).data('id');
    let tr = this
    Swal.fire({ 
        title: 'Apakah anda yakin ?',
        text: "Data ini akan dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value)  {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        '_method': 'DELETE',
                        '_token': token,
                        'id': id
                    },
                    dataType: "JSON",
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            response.success,
                            'success'
                        )
                        $(tr).closest('tr').remove();
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swal.fire(
                    'Hapus data dibatalkan!',
                    'Data yang ingin anda hapus telah dibatalkan',
                    'error'
                )
            }
            
        });
    });
</script>
@endpush