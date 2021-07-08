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
            @forelse ($data as $item)
            <div class="card d-flex shadow mx-3">
              <div class="card-body d-flex justify-content-between">
                <div>
                  <p>{{ ($item->deskripsi) }}</p>
                  <small class="m-0" style="font-size: 13px;">{{ number_format($item->km_awal) }} km - {{ number_format($item->km_akhir) }} km</small>
                  <small class="badge badge-pill {{ ($item->status == 'SELESAI') ? 'badge-success' : 'badge-primary' }} px-4 py-2 rounded">{{ $item->status }}</small>

                </div>
                <div>
                  <a class="badge badge-danger badge-pill px-3 py-2 text-white" onclick="event.preventDefault(); document.getElementById('form-delete').submit();">
                    <span><i class="fas fa-trash"></i></span>
                  </a>
                  <form id="form-delete" action="{{ route('aktivitas.destroy', $item->id) }}" method="POST" class="d-none">
                    @method('DELETE')
                    @csrf
                  </form>
                </div>
              </div>
            </div>
            @empty
            <h6 class="text-center mt-2">Tidak Ada Catatan</h6>
            @endforelse




        </div>
    </div>
</div>
@endsection
