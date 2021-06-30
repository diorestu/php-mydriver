@extends('layouts.backend')

@section('title')

@endsection

@push('addon-style')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Lembur Bulan Ini</h1>
    <div>
        <a href="{{ route('lembur.export') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak Rekapan Lembur
        </a>

        {{-- <a href="{{ route('user.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm px-3 py-2 rounded">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
        </a> --}}
    </div>
</div>

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="crudTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="2%">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kehadiran</th>
                                <th class="text-center">Lama Lembur</th>
                                <th class="text-center">Nilai Lembur</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" >Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($absensi as $item)
                                @php
                                if ($item->hadir) {
                                    $hadir = Carbon\Carbon::parse($item->hadir);
                                    $pulang = Carbon\Carbon::parse($item->pulang);
                                }else{
                                    $hadir = "-";
                                    $pulang = "-";
                                }
                                @endphp
                            <tr>
                                <td class="text-center" style="vertical-align: middle;">{{ $no++ }}</td>
                                <td style="vertical-align: middle;">{{ $item->user->name }}</td>
                                <td class="text-center">{{ Carbon\Carbon::parse($hadir)->locale('id')->isoFormat('dddd, LL') }}</br>{{ Carbon\Carbon::parse($hadir)->format('H:i') }} - {{ Carbon\Carbon::parse($pulang)->format('H:i') }}</td>
                                <td style="vertical-align: middle;" class="text-center">{{ $item->jam }} Jam</td>
                                <td style="vertical-align: middle;" class="text-center">Rp. {{ number_format($item->harga) }}</td>
                                <td style="vertical-align: middle;" class="text-center"><span class="badge badge-pill {{ ($item->status == 'PENDING') ? 'badge-warning' : 'badge-success' }} py-2 px-3">{{ $item->status }}</span></td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <ul class="list-inline">
                                        <li class="list-inline-item {{ ($item->status == 'PENDING') ? '' : 'd-none' }}">
                                            <a href="{{ route('lembur.show', $item->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item ">
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
        $('#crudTable').DataTable({
            columns: [
            null,
            null,
            {
            orderable: false,
            searchable: false,
            },
            null,
            null,
            null,
            {
                orderable: false,
                searchable: false,
            },
            ]
        });
    } );
</script>
@endpush
