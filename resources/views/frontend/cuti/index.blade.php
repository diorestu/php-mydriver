@extends('layouts.frontend')

@section('title')
Cuti
@endsection

@section('content')
<div class="projects">
  <!-- Header -->
  <div class="navbar two-action no-hairline sticky-top">
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
      @forelse ($data as $item)
      <div class="card d-flex shadow mb-2">
        <div class="card-body d-flex justify-content-between">
          <div class="pr-2">
            <h6>{{ $item->deskripsi }}</h6>
            <small class="text-muted">{{ Carbon\Carbon::parse($item->mulai)->locale('id')->isoFormat('LL') }}
              s/d
              {{ Carbon\Carbon::parse($item->selesai)->locale('id')->isoFormat('LL') }}
            </small>
            <br>
            <span class="badge badge-pill {{ ($item->status == 0) ? 'badge-warning' : 'badge-success'}} px-4 py-2 mt-2">{{ ($item->status == 0) ? 'Pending' : 'Diterima'}}</span>
          </div>
          <div class="pl-3 d-flex align-items-end">
            <a class="badge badge-danger badge-pill px-3 py-2 text-white" onclick="event.preventDefault(); document.getElementById('form-delete').submit();">
              <span><i class="fas fa-trash"></i></span>
            </a>
            <form id="form-delete" action="{{ route('cuti.destroy', $item->id) }}" method="POST" class="d-none">
              @method('DELETE')
              @csrf
            </form>
          </div>
        </div>
      </div>
      @empty
      <div class="text-center">
        <h6>Belum Ada Pengajuan</h6>
      </div>
      @endforelse
    </div>
  </div>
</div>
@endsection
