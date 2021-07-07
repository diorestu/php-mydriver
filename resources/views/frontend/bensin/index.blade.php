@extends('layouts.frontend')

@section('title')
Riwayat Bahan Bakar
@endsection


@section('content')
<div class="">
    <!-- Header -->
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('beranda') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                    {{-- <span>Kembali</span> --}}
                </a>
            </div>
            <div class="sliding custom-title">Riwayat Bahan Bakar</div>
            <div class="right mr-2">
                <a href="{{ route('bensin.create') }}" class="link icon-only">
                    <i class="material-icons">add</i>
                </a>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="list no-hairlines media-list project-list mx-3">
            @forelse ($data as $item)
            <div class="card d-flex shadow">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h4>Rp. {{ number_format($item->harga) }}</h4>
                        <small
                            class="text-muted">{{ Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('LL') }}</small>
                        <span class="badge badge-warning badge-pill mx-2 px-3 py-2">Status
                        </span>
                    </div>
                    <div>
                        <a class="badge badge-danger badge-pill px-3 py-2 text-white"
                            onclick="event.preventDefault(); document.getElementById('form-delete').submit();">
                            <span><i class="fas fa-trash"></i></span>
                        </a>
                        <form id="form-delete" action="{{ route('bensin.destroy', $item->id) }}" method="POST"
                            class="d-none">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center">
                <h5>Belum Ada Catatan</h5>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
