@extends('layouts.member')
@section('title')
    Daftar Produk
@endsection

@section('content')
@if (count($products))
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Daftar Produk</h1>
                        <a href="{{ route('products-seller.create')}}" class="btn btn-success shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah Produk Baru
                        </a>
                    </div>
                    <div class="table-responsive">
                    <table id="example1" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kategori Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Diskon</th>
                            <th>Jumlah Diskon</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td style="padding-left: 33px">{{ $loop->iteration }}</td>
                                    <td style="padding-left: 26px">{{ $product->category->name_category }}</td>
                                    <td style="padding-left: 26px">{{ $product->name_product }}</td>
                                    <td style="padding-left: 26px">{{ $product->price }}</td>
                                    @if ($product->stock == 'Tersedia')
                                        <td>
                                            <span class="badge badge-success">Tersedia</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-danger">Habis</span>
                                        </td>
                                    @endif
                                    @if ($product->discount == true)
                                        <td style="padding-left: 26px">
                                            <span class="badge badge-success">Aktif</span>
                                        </td>
                                        @else
                                        <td style="padding-left: 26px">
                                            <span> - </span>
                                        </td>
                                    @endif
                                    @if ($product->discount == true)
                                        <td style="padding-left: 26px">{{ $product->discount_amount }}%</td>
                                        @else
                                        <td style="padding-left: 26px"> - </td>
                                    @endif
                                        
                                    <td style="padding-left: 26px;">
                                        <div class="form-group d-flex my-2">
                                            @if ($product->discount == 1)
                                                <form action="{{ route('products-seller.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="discount" class="form-input" value="0">
                                                    <input type="hidden" name="discount_amount" class="form-input" value="0">
                                                    <button type="submit" class="btn btn-sm btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Nonaktifkan Diskon"><i class="fas fa-percent"></i></button>
                                                </form>
                                                @else
                                                    <form action="{{ route('products-seller.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="discount" value="0">
                                                        <button hidden type="submit" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Nonaktifkan Diskon"><i class="fas fa-badge-percent"></i></button>
                                                    </form>
                                            @endif
                                            <form action="{{ route('products-seller.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                @if ($product->stock == 'Tersedia')
                                                    <input type="hidden" name="stock" class="form-input" value="Habis">
                                                    <button type="submit" class="btn btn-sm btn-secondary mr-2" data-toggle="tooltip" data-placement="top" title="Jadikan Stok Habis"><i class="fas fa-store-slash"></i></button>
                                                @else
                                                    <input type="hidden" name="stock" class="form-input" value="Tersedia">
                                                    <button type="submit" class="btn btn-sm btn-success mr-2" data-toggle="tooltip" data-placement="top" title="Jadika Stok Tersedia"><i class="fas fa-store"></i></button>
                                                @endif
                                            </form>

                                            

                                            <a href="{{ route('products-seller.edit', $product->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Edit Produk"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('products-seller.destroy', $product->id) }}"  class="btn btn-sm btn-danger mx-1 btn-delete" id="hapus" data-toggle="tooltip" data-placement="top" title="Hapus {{ $product->name_product }}" aria-valuetext="{{ $product->name_product }}"><i class="fas fa-trash"></i></i></a>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row py-5">
                        <div class="col-md-12">
                            <div class="no-data text-center">
                                <figure class="figure">
                                    <img src="{{ url('/images/ic_empty_data.svg') }}" class="img-fluid figure-img h-25 w-25" alt="">
                                </figure>
                                <div class="description">
                                    <h3>Belum ada Produk!</h3>
                                    silahkan untuk menambahkan data terlebih dahulu
                                </div>
                                <div class="add-slider mt-4">
                                    <a href="{{ route('products-seller.create')}}" class="btn btn-success shadow-sm">
                                        <i class="fas fa-plus fa-sm text-white-50"></i>
                                        Tambah Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>
<script>
    $('body').on('click', '.btn-delete', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('aria-valuetext'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    let tr = this;
    Swal.fire({

        title: 'Apakah anda yakin ?',
        text: 'Produk ' + name + ' akan dihapus',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    Swal.fire(
                        'Berhasil Dihapus!',
                        'Produk ' + name + ' telah dihapus',
                        'success'
                    ),
                    $(tr).closest('tr').remove();
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Produk ' + name + ' Gagal Dihapus',
                    });
                }
            });
        }
    });
});
</script>
@endpush