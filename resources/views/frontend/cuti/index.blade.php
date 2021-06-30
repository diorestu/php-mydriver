@extends('layouts.frontend')

@section('title')
Cuti
@endsection

@section('content')
<div class="projects">
    <!-- Header -->
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('beranda') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                    {{-- <span>Kembali</span> --}}
                </a>
            </div>
            <div class="sliding custom-title">Riwayat Cuti Saya</div>
            <div class="right mr-2">
                <a href="{{ route('cuti.create') }}" class="link icon-only">
                    <i class="material-icons">add</i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Header -->

    <div class="page-content">
        <div class="list no-hairlines media-list project-list mx-3">
            <div class="container">
                <ul class="row">
                    @forelse ($data as $item)
                    <li class="col-12">
                        <a href="{{ route('cuti.show', $item->id) }}" class="item-link item-content pl-0 pr-0">
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">
                                        <h4><strong>{{ $item->deskripsi }}</strong></h4>
                                    </div>
                                </div>
                                <div class="item-subtitle"> {{ $item->tipe }}</div>
                                <div class="pro-info clearfix">
                                    <div class="pro-left">
                                        <p>{{ Carbon\Carbon::parse($item->mulai)->locale('id')->isoFormat('dddd, LL') }}
                                            s/d
                                            {{ Carbon\Carbon::parse($item->selesai)->locale('id')->isoFormat('dddd, LL') }}
                                        </p>
                                    </div>
                                    <div class="pro-right">
                                        <p class="badge {{ ($item->status == 0) ? 'badge-warning' : 'badge-success'}} px-4 py-2 rounded">{{ ($item->status == 0) ? 'Pending' : 'Diterima'}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="col-12">
                        <h5 class="text-center p-4">Tidak Ada Data Pengajuan</h5>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
