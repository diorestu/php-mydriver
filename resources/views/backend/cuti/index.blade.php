@extends('layouts.backend')

@section('title')
    Data Cuti
@endsection

@push('addon-style')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Cuti Bulan Ini</h1>
    <div>
        <a href="javascript:void;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Ekspor Laporan
        </a>
    </div>

</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Cuti : {{ Carbon\Carbon::now()->isoFormat('dddd, LL') }}</h5>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="crudTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Nama</th>
                                <th width="15%" class="text-center">Jenis Cuti</th>
                                <th width="15%" class="text-center">Keterangan</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center" width="5%">Status</th>
                                <th class="text-center" width="5%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($staff as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->tipe }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->mulai }} s/d {{ $item->selesai }}</td>
                                <td><span class="badge badge-pill badge-sm px-3 py-2 {{ ($item->status == 'PENDING') ? 'badge-warning' : 'badge-success' }}">{{ $item->status }}</span></td>
                                <td class="text-center">
                                    <ul class="list-inline">
                                        <li class="list-inline-item {{ ($item->status == 'PENDING') ? '' : 'd-none' }}">
                                            <a href="{{ route('leave.show', $item->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </li>
                                    </ul>
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
