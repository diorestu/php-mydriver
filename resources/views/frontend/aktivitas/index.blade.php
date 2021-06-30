@extends('layouts.frontend')

@section('title')
    Riwayat Aktivitas
@endsection

@section('content')
<div class="projects">
    <!-- Header -->
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('beranda') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left fa-xs"></i>
                </a>
            </div>
            <div class="sliding custom-title">Aktivitas</div>
            <div class="right mr-2">
                <a href="{{ route('aktivitas.create') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-plus fa-xs"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Header -->

    <div class="page-content">
        <div class="list no-hairlines media-list project-list">
            <div class="container">
                <ul class="row">
                    @forelse ($data as $item)
                    <li class="col-12">
                        <a href="javascript:void;" class="item-link item-content p-0 pt-2">
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">
                                        <h4 class="mb-1">{{ $item->deskripsi }}</h4>
                                    </div>
                                </div>
                                <p class="m-0" style="font-size: 13px;">{{ number_format($item->km_awal) }} km - {{ number_format($item->km_akhir) }} km</p>
                                <div class="pro-info clearfix">
                                    <div class="pro-left">
                                        <p>{{ Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, LL') }}</p>
                                    </div>
                                    <div class="pro-right">
                                        <p class="badge badge-pill {{ ($item->status == 'SELESAI') ? 'badge-success' : 'badge-primary' }} px-4 py-2 rounded">{{ $item->status }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="col-12 text-center">
                        <h5 class="pt-3 p-1">Tidak Ada Data Riwayat Aktivitas</h5>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
