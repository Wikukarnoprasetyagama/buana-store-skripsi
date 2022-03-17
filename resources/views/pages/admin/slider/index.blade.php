@extends('layouts.app')
@section('title')
    Daftar Slider
@endsection

@section('content')
@if (count($slider))
<section class="main-content">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0 text-gray-800">Data Slider </h3>
                <a href="{{ route('sliders.create')}}" class="btn btn-success shadow-sm" style="border-radius: 4px">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Tambah Slider
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                            <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                                <td style="padding-left: 24px">{{ $loop->iteration }}</td>
                                <td style="padding-left: 18px">
                                    <img src="{{ Storage::url($slider->photo) }}" alt="gambar-slider" class="img-fluid" style="max-height: 40px">
                                </td>
                                <td style="padding-left: 18px">{{ $slider->name }}</td>
                                <td style="padding-left: 15px;">
                                    <div class="form-group d-flex">
                                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-warning mx-1" data-toggle="tooltip" data-placement="top" title="Edit {{ $slider->name }}"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('sliders.destroy', $slider->id) }}" class="btn btn-sm btn-danger mx-1 btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus {{ $slider->name }}" aria-valuetext="{{ $slider->name }}"><i class="fas fa-trash"></i></i></a>
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
</section>

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
                                    <h3>Belum ada Slider!</h3>
                                    silahkan untuk menambahkan data terlebih dahulu
                                </div>
                                <div class="add-slider mt-4">
                                    <a href="{{ route('sliders.create')}}" class="btn btn-success shadow-sm">
                                        <i class="fas fa-plus fa-sm text-white-50"></i>
                                        Tambah Slider
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
        text: 'Data ' + name + ' akan dihapus',
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
                        'Data ' + name + ' telah dihapus',
                        'success'
                    ),
                    $(tr).closest('tr').remove();
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Kategori ' + name + ' gagal dihapus!',
                    });
                }
            });
        }
    });
});
</script>
@endpush