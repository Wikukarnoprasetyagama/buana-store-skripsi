@extends('layouts.app')

@section('title')
    DATA MEMBER
@endsection

@section('content')
    <!-- Main content -->
    <section class="main-content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0 text-gray-800">Data Member Buana Store</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-hover scroll-horizontal-vertical w-100">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Roles</th>
                            <th>No. Hp</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                    $no = 1;
                            @endphp
                            @foreach ($members as $member)
                                <tr>
                                    <td style="padding-left: 24px">{{ $no++ }}</td>
                                    <td style="padding-left: 18px">{{ $member->email }}</td>
                                    <td style="padding-left: 18px">{{ $member->name }}</td>
                                    @if ($member->roles == 'SELLER')
                                        <td style="padding-left: 18px"><span class="badge badge-success">{{ $member->roles }}</span></td>
                                    @else
                                        <td style="padding-left: 18px"><span class="badge badge-primary">{{ $member->roles }}</span></td>
                                    @endif
                                    @if ($member->phone != null)
                                        <td style="padding-left: 18px">{{ $member->phone }}</td>
                                    @else
                                        <td class="text-center" style="padding-left: 18px"> - </td>
                                    @endif
                                    @if ($member->status == 'NONE')
                                        <td class="text-center" style="padding-left: 18px"> - </td>
                                    @else
                                        @if ($member->status == 'DIBLOKIR')
                                            <td style="padding-left: 18px"><strong class="text-danger">{{ $member->status }}</strong></td>
                                            @elseif ($member->status == 'PENDING')
                                            <td style="padding-left: 18px"><strong class="text-warning">{{ $member->status }}</strong></td>
                                            @else
                                            <td style="padding-left: 18px"><strong class="text-success">{{ $member->status }}</strong></td>
                                        @endif
                                    @endif
                                    <td style="padding-left: 18px;">
                                        <div class="form-group d-flex justify-content-between">
                                            <form action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                            <input type="hidden" name="status" class="form-input" value="DIBLOKIR">
                                            <button type="submit" class="btn btn-sm btn-danger mx-1" data-toggle="tooltip" data-placement="top" title="Nonaktifkan"><i class="fas fa-user-slash"></i></button>
                                        </form>
                                        <form action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" class="form-input" value="TERVERIFIKASI">
                                            <button type="submit" class="btn btn-sm btn-success mx-1" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fas fa-user-check"></i></button>
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