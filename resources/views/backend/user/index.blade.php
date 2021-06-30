@extends('layouts.backend')

@section('title')

@endsection

@push('addon-style')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
    <div>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a> --}}
        <a href="{{ route('user.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm px-3 py-2 rounded">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data

        </a>

    </div>

</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="crudTable">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="3%">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Unit Kerja</th>
                                <th class="text-center">Nama Pengguna</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" width="5%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($staff as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ strtoupper($item->name) }}</td>
                                <td>{{ ($item->unitkerja == null) ? $item->cabang->cabang : $item->unitkerja->nama }}</td>
                                <td class="text-center">
                                    {{ ($item->roles == 1) ? 'Pengawas' : 'Driver' }}
                                </td>
                                <td>{{ strtolower($item->username) }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('user.show', $item->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('user.edit', $item->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan='6' class="text-center">Tidak Ada Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready( function () {
        $('#crudTable').DataTable();
    } );
</script>
@endpush
