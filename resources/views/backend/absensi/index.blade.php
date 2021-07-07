@extends('layouts.backend')

@section('title')

@endsection

@push('addon-style')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
    <div class="">
        <a href="{{ route('absen.export') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak Absensi Hari Ini
        </a>
        <a href="{{ route('absen.create') }}" class="{{ (auth()->user()->roles != 1)? 'd-none' : '' }} btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Absensi
        </a>
    </div>

</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Absensi :
                    {{ Carbon\Carbon::now()->isoFormat('dddd, LL') }}</h5>
                <div>
                    <form class="form-inline" method="post" action="{{ route('absensi.cari') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="form-control mr-2" type="date" name="tanggal">
                        <button class="btn btn-primary" type="cubmit">Cari</button>
                    </form>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="crudTable">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Nama</th>
                                <th width="15%" class="text-center">Jam Hadir</th>
                                <th width="15%" class="text-center">Jam Pulang</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center" width="5%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td class="text-center">
                                    {{ ($item->hadir != null    ) ? Carbon\Carbon::parse($item->hadir)->format('H:i') : '--:--' }}
                                </td>
                                <td class="text-center">
                                    {{ ($item->pulang != null) ? Carbon\Carbon::parse($item->pulang)->format('H:i') : '--:--' }}
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('absensi.show', $item->id) }}">
                                        <span class="badge badge-pill badge-info px-3 py-2"><i class="fas fa-eye"></i> Detail</span>
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

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Belum Absensi</h5>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="crudTable2">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Nama</th>
                                <th width="15%" class="text-center">Jam Hadir</th>
                                <th width="15%" class="text-center">Jam Pulang</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @forelse ($dataoff as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    {{ ($item->hadir != null    ) ? Carbon\Carbon::parse($item->hadir)->format('H:i') : '--:--' }}
                                </td>
                                <td class="text-center">
                                    {{ ($item->pulang != null) ? Carbon\Carbon::parse($item->pulang)->format('H:i') : '--:--' }}
                                </td>
                                <td>{{ $item->deskripsi }}</td>
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
            language: {
                searchPlaceholder: "Search records"
            }
        });
    } );
    $(document).ready( function () {
        $('#crudTable2').DataTable({
            language: {
                searchPlaceholder: "Search records"
            }
        });
    } );
</script>
@endpush
