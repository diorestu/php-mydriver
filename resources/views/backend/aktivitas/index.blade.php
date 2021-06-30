@extends('layouts.backend')

@section('title')

@endsection

@push('addon-style')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Aktivitas Driver</h1>
    <div>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a> --}}
        <a href="{{ route('task.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm px-3 py-2 rounded">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Order
        </a>
    </div>

</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Histori {{ Carbon\Carbon::now()->isoFormat('dddd, LL') }}</h5>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" id="crudTable">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Nama</th>
                                <th  class="text-center">Mobil</th>
                                <th width="15%" class="text-center">User</th>
                                <th width="15%" class="text-center">Penggunaan</th>
                                <th width="10%" class="text-center">Aktivitas</th>
                                <th width="10%" class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($data as $item)
                            <tr>

                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ ucwords(strtolower($item->user->name)) }}</td>
                                <td class="text-center">{{ ($item->id_mobil != 0) ? $item->mobil->nama : 'Menunggu' }}</br>{{ ($item->id_mobil != 0) ? $item->mobil->plat : '' }}</td>
                                <td class="text-center">{{ $item->customer }}</td>
                                <td class="text-center">{{ $item->km_awal }} - {{ $item->km_akhir }}</td>
                                <td class="text-center" style="vertical-align: middle;">
                                    @php
                                        if($item->status == 'SELESAI'){
                                            $badge = 'badge-success';
                                        }elseif($item->status == 'AKTIF'){
                                            $badge = 'badge-primary';
                                        }else{
                                            $badge = 'badge-danger';
                                        }
                                    @endphp
                                    <span class="px-3 py-2 badge badge-pill {{ $badge }}">{{ $item->status }}</span>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <a href="{{ route('task.show', $item->id) }}">
                                    <span class="badge badge-pill badge-danger {{ ($item->status === 'SELESAI' || $item->status === 'BATAL') ? 'd-none' : '' }} px-3 py-2">BATAL</span>
                                    </a>
                                    <a href="{{ route('task.edit', $item->id) }}">
                                        <span
                                            class="badge badge-pill badge-info {{ ($item->status === 'AKTIF' || $item->status === 'BATAL') ? 'd-none' : '' }} px-3 py-2">{{ ($item->rating != null) ? '✓' : 'REVIEW'}}</span>
                                    </a>
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
