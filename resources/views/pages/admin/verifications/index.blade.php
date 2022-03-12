@extends('layouts.app')
@section('title')
    Daftar Permintaan Pembukaan Toko
@endsection

@section('content')

@if (count($member))
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4 pt-5">
                            <h1 class="h3 mb-0 text-gray-800">Daftar Permintaan Pembukaan Toko</h1>
                        </div>
                        <div class="table-responsive">
                    <table id="example1" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pemilik</th>
                            <th>Nama Toko</th>
                            <th>Nama Desa</th>
                            <th>No. Hp</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td style="padding-left: 24px">{{ $loop->iteration }}</td>
                                    @if ($member->name)
                                        <td style="padding-left: 18px">{{ $member->name }}</td>
                                    @else
                                    <td style="padding-left: 18px"> - </td>
                                    @endif
                                    @if ($member->name_store)
                                        <td style="padding-left: 18px">{{ $member->name_store }}</td>
                                    @else
                                        <td style="padding-left: 18px"> - </td>
                                    @endif
                                    @if ($member->village == true)
                                        <td style="padding-left: 18px">{{ $member->village }}</td>
                                    @else
                                        <td style="padding-left: 18px"> - </td>
                                    @endif
                                    @if ($member->phone == true)
                                        <td style="padding-left: 18px">{{ $member->phone }}</td>
                                    @else
                                        <td style="padding-left: 18px"> - </td>
                                    @endif
                                    <td style="padding-left: 18px;">
                                        <a href="{{ route('verification.show', $member->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
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
                            <div class="no-verification text-center">
                                <figure class="figure">
                                    <img src="{{ url('/images/ic_empty.svg') }}" class="img-fluid figure-img h-50 w-50" alt="">
                                </figure>
                                <div class="description">
                                    <h3>Belum ada Data!</h3>
                                    Tidak ada member yang perlu di verifikasi
                                </div>
                                <a href="{{ route('dashboard-admin') }}" class="btn btn-success mt-5">Kembali</a>
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
            {data: 'name', name: 'name'},
            {data: 'name_store', name: 'name_store'},
            {data: 'village', name: 'village'},
            { 
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '30%' 
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