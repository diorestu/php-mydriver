@extends('layouts.backend')

@section('title')
Dashboard
@endsection

@push('addon-style')
<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>

@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pembelian Bensin Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($c) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Driver Tersedia</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $driver }} Driver</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Aktivitas Hari Ini
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $count }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pengajuan Cuti</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cuti }} </div>
                    </div>

                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row {{ (auth()->user()->roles == 1) ? '' : 'd-none' }}">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="p-4">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                Riwayat Aktivitas Terbaru
            </div>
            <div class="card-body">
                <ul class="timeline">
                    @foreach ($act as $item)
                    @php
                        if($item->status == 'SELESAI'){
                            $badge = 'badge-success';
                        }elseif($item->status == 'AKTIF'){
                            $badge = 'badge-primary';
                        }else{
                            $badge = 'badge-danger';
                        }
                    @endphp
                    <li class="mb-0">
                        <p>{{ Carbon\Carbon::parse($item->created_at)->format('h:i') }} <span class="badge badge-pill {{ $badge }} px-2 py-1">{{ $item->status }}</span></p>
                        <p>{{ $item->user->name }} </p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                Ceklis Sopir Hari Ini
            </div>
            <div class="card-body">
                <ul class="">
                    @foreach ($ceklis as $item)
                    <li class="col-12">
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">
                                        <h5 class="m-0 text-success"><strong>{{ $item->user->name }}</strong></h5>
                                    </div>
                                </div>
                                <div class="pro-info clearfix">
                                    <div class="pro-right">
                                        <p
                                            class="badge {{ ($item->washed == 'Ya') ? 'badge-success' : 'badge-danger'}} px-2 py-1 badge-pill badge-sm">
                                            Cuci Mobil</p>
                                        <p
                                            class="badge {{ ($item->tisu == 'Ada') ? 'badge-success' : 'badge-danger'}} px-2 py-1 badge-pill badge-sm">
                                            Tisu</p>
                                        <p class="badge {{ ($item->box == 'Ada') ? 'badge-success' : 'badge-danger'}} px-2 py-1 badge-pill badge-sm">
                                            Kotak Sampah</p>
                                        <p
                                            class="badge {{ ($item->parfum == 'Ada') ? 'badge-success' : 'badge-danger'}} px-2 py-1 badge-pill badge-sm">
                                            Pengharum</p>
                                        <p
                                            class="badge {{ ($item->sanitizer == 'Ada') ? 'badge-success' : 'badge-danger'}} px-2 py-1 badge-pill badge-sm">
                                            Hand Sanitizer</p>
                                        <p
                                            class="badge {{ ($item->masker == 'Ada') ? 'badge-success' : 'badge-danger'}} px-2 py-1 badge-pill badge-sm">
                                            Masker</p>
                                    </div>
                                </div>
                            </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="{{ LarapexChart::cdn() }}"></script>
{{ $chart->script() }}
@endpush
