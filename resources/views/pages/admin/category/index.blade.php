@extends('layouts.app')
@section('title')
    Daftar Kategori Produk
@endsection

@section('content')
@if (count($category))
<section class="main-content">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0 text-gray-800">Data Member Buana Store</h3>
                <a href="{{ route('category.create')}}" class="btn btn-success shadow-sm" style="border-radius: 4px">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Tambah Kategori
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                            <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($categories as $category)
                            <tr>
                                <td style="padding-left: 24px">{{ $no++ }}</td>
                                <td style="padding-left: 18px">
                                    <img src="{{ Storage::url($category->photo) }}" alt="gambar-kategori" class="img-fluid" style="max-height: 40px">
                                </td>
                                <td style="padding-left: 18px">{{ $category->name_category }}</td>
                                <td style="padding-left: 15px;">
                                    <div class="form-group d-flex">
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning mx-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger mx-1" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
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
                                    <h3>Belum ada Kategori!</h3>
                                    silahkan untuk menambahkan data terlebih dahulu
                                </div>
                                <div class="add-slider mt-4">
                                    <a href="{{ route('category.create')}}" class="btn btn-success shadow-sm">
                                        <i class="fas fa-plus fa-sm text-white-50"></i>
                                        Tambah Kategori
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
    var datatable =  $('#table').DataTable({
        processing: true,
        serverSide:true,
        ordering:true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns:[
            {data: 'id', name: 'id'},
            {data: 'photo', name: 'photo'},
            {data: 'name_category', name: 'name_category'},
            { 
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%' 
            },
        ]
    })
    
</script>
<script>
    $(document).on('click', '#hapus', function(){
    let url = $(this).data('url');
    let token = $(this).data('token')
    let id = $(this).data('id');
    let tr = this
    Swal.fire({ 
        title: 'Data ini akan di hapus',
        text: "Apakah anda yakin ?",
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
                    'Dibatalkan!',
                    'Data yang ingin anda hapus berhasil dibatalkan',
                    'error'
                )
            }
            
        });
    });
</script>
@endpush