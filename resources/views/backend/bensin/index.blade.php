@extends('layouts.backend')

@section('title')

@endsection

@push('addon-style')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pengisian Bahan Bakar</h1>
    <div>
        <a href="{{ route('bensin.export') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak Rekapan
        </a>
        <a href="{{ route('bbm.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th width="15%" class="text-center">Mobil</th>
                                <th width="15%" class="text-center">Kilometer</th>
                                <th class="text-center">Jumlah Pembelian</th>
                                <th class="text-center">Tanggal Pembelian</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td class="text-center">{{ $item->mobil->nama }}</br>{{ $item->mobil->plat }}</td>
                                <td class="text-center">{{ number_format($item->km) }} km</td>
                                <td class="text-center">Rp. {{ number_format($item->harga) }}</td>
                                <td class="text-center">{{ $item->tanggal }}</td>
                                <td class="text-center">
                                    <a href="{{ route('bbm.show', $item->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i>
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
