@extends('layouts.frontend')

@section('title')
Check List Harian
@endsection

@push('addon-style')

@endpush

@section('content')
<div class="projects bg-lines">
    <!-- Header -->
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('beranda') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                    {{-- <span>Kembali</span> --}}
                </a>
            </div>
            <div class="sliding custom-title">Check List Harian</div>
            <div class="right mr-2">
                <a href="{{ route('ceklis.create') }}" class="link icon-only {{ ($data == null) ? 'd-none' : '' }}">
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
                        <a href="{{ route('ceklis.show', $item->id) }}" class="item-link item-content pl-0 pr-0">
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">
                                        <h5><strong>{{ $item->mobil->nama }} - {{ $item->mobil->plat }}</strong></h5>
                                    </div>
                                </div>
                                <p>{{ Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('LL') }}</p>
                                <div class="pro-info clearfix">
                                    <div class="pro-right">
                                        <p class="badge {{ ($item->washed == 'Ya') ? 'badge-success' : 'badge-danger'}} badge-pill px-4 py-2">Cuci Mobil</p>
                                        <p class="badge {{ ($item->tisu == 'Ada') ? 'badge-success' : 'badge-danger'}} px-4 py-2 badge-pill">Tisu</p>
                                        <p class="badge {{ ($item->box == 'Ada') ? 'badge-success' : 'badge-danger'}} px-4 py-2 badge-pill">Kotak Sampah</p>
                                        <p class="badge {{ ($item->parfum == 'Ada') ? 'badge-success' : 'badge-danger'}} px-4 py-2 badge-pill">Pengharum</p>
                                        <p class="badge {{ ($item->sanitizer == 'Ada') ? 'badge-success' : 'badge-danger'}} px-4 py-2 badge-pill">Hand Sanitizer</p>
                                        <p class="badge {{ ($item->masker == 'Ada') ? 'badge-success' : 'badge-danger'}} px-4 py-2 badge-pill">Masker</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="col-12 text-center">
                        <h4 class="text-center mt-3">Anda Belum Input Ceklis Harian</h4>
                        <a href="{{ route('ceklis.create') }}" class="badge badge-pill badge-primary mb-3 px-3 py-1">Ceklis Harian Saya
                        </a>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
