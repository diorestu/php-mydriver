@extends('layouts.frontend')

@section('title')
Dashboard
@endsection

@section('content')
<!-- Header -->
<div class="navbar two-action no-hairline">
  <div class="navbar-inner d-flex align-items-center justify-content-between">
    <div class="left">
      <a href="#" class="link icon-only"><i class="material-icons">menu</i></a>
    </div>
  </div>
</div>
<!-- /Header -->

<!-- Page Content -->
<div class="page-content mt-0">
  <div class="profile-header pt-2">
    <div class="row pb-3">
      <div class="col-5 d-flex align-items-center px-0">
        <div class="pro-img-box">
          <img alt="" src="{{ ($data->photos == null) ? asset('frontend/assets/img/user.jpg') : asset('storage/uploads/'.$data->photos)}}">
        </div>
      </div>
      <div class="col-7 px-0 d-flex align-items-center">
        <div class="pro-user-det text-left">
          <div class="profile-name">
            <h6 class="pr-2">{{ strtoupper($data->name) }}</h6>
          </div>
          <div class="profile-designation">
            <p class="mb-0 pr-2"><strong>BPD Bali - {{ ($data->unitkerja == null) ? $data->cabang->cabang : $data->unitkerja->nama }}</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-box my-0 py-0">
      <h6 class="text-center mt-2">Absensi {{ Carbon\Carbon::now()->locale('id')->isoFormat('dddd, LL') }}</h6>
    <div class="row">
      <div class="col-6 pr-2">

        @php
        if($absen != null){
            if($absen->hadir != null){
                $hadir = Carbon\Carbon::parse($absen->hadir)->format('H:i');
                if ($absen->pulang != null) {
                    $pulang = Carbon\Carbon::parse($absen->pulang)->format('H:i');
                }else{
                    $pulang ='--:--';
                }
            }else{
                $hadir ='--:--';
            }
        }else{
            $hadir ='--:--';
            $pulang ='--:--';
        }
        @endphp

        <div class="punch-widget">
          <h2><strong>{{ $hadir }}</strong></h2>
          <p><strong>Jam Hadir</strong></p>
        </div>
      </div>
      <div class="col-6 pl-2">
        <div class="punch-widget">
          <h2><strong>{{ $pulang }}</strong></h2>
          <p><strong>Jam Pulang</strong></p>
        </div>
      </div>
    </div>
  </div>
  <div class="container mt-3">
    <div class="dash-widget pt-1 {{ (auth()->user()->roles == 4) ? '' : 'd-none' }}">
      <div class="dash-widget-info">
        @php
        if($aktivitas != null){
        echo '<h5>'.$aktivitas->customer.'</h5>';
        echo '<p>'. $aktivitas->deskripsi .'</p>';
        echo '<ul class="list-inline mt-2">
          <li class="list-inline-item">
            <a href="'.route('aktivitas.edit', $aktivitas->id).'"><span class="badge badge-pill badge-primary px-3 py-2">Selesaikan Tugas</span></a>
          </li>
          <li class="list-inline-item">
            <a href="tel:'.$aktivitas->cust_phone.'"><span class="badge badge-pill badge-success px-3 py-2">Hubungi User</span>
            </a>
          </li>
        </ul>';
        }else{
        echo '<h5>Tidak Ada Aktivitas Terbaru</h5>';
        }
        @endphp
      </div>
    </div>

    {{-- <div class="card card-custom">
      <div class="card-body d-flex justify-content-between ">
        <div class="text-center ml-3">
          <span>
            <i class="fas fa-user-clock fa-lg"></i>
          </span>
        <br>
          <small>Absensi</small>
        </div>
        <div class="text-center">
          <span>
            <i class="fas fa-gas-pump fa-lg"></i>
          </span>
          <br>
          <small>BBM</small>
        </div>
        <div class="text-center mr-3">
          <span>
            <i class="fas fa-star fa-lg"></i>
          </span>
          <br>
          <small>Aktivitas</small>
        </div>
      </div>
    </div> --}}

    <div class="dashboard-area mt-2">
      <div class="row">
        <div class="col-6 pr-2">
          <a href="{{ route('ceklis.index') }}">
            <div class="dash-widget pb-0">
              <div class="dash-widget-icon"><i class="fas fa-check"></i></div>
              <div class="dash-widget-info">
                <h6>Ceklis Harian</h6>
              </div>
            </div>
          </a>
        </div>
        <div class="col-6 pl-2">
          <a href="{{ route('absen.index') }}">
            <div class="dash-widget pb-0">
              <div class="dash-widget-icon"><i class="fas fa-user-clock"></i></div>
              <div class="dash-widget-info">
                <h6>Absensi</h6>
              </div>
            </div>
          </a>
        </div>
        <div class="col-6 pr-2">
          <a href="{{ route('bensin.index') }}">
            <div class="dash-widget pb-0">
              <div class="dash-widget-icon"><i class="fas fa-gas-pump"></i></div>
              <div class="dash-widget-info">
                <h6>BBM</h6>
              </div>
            </div>
          </a>
        </div>
        <div class="col-6 pl-2">
          <a href="{{ route('aktivitas.index') }}">
            <div class="dash-widget pb-0">
              <div class="dash-widget-icon"><i class="fas fa-star-half-alt"></i></div>
              <div class="dash-widget-info">
                <h6>Aktivitas</h6>
              </div>
            </div>
          </a>
        </div>
        <div class="col-6 pr-2">
          <a href="{{ route('cuti.index') }}">
            <div class="dash-widget pb-0">
              <div class="dash-widget-icon"><i class="fas fa-calendar-times"></i></div>
              <div class="dash-widget-info">
                <h6>Cuti</h6>
              </div>
            </div>
          </a>
        </div>
        <div class="col-6 pl-2">
          <a href="{{ route('car.create') }}">
            <div class="dash-widget pb-0">
              <div class="dash-widget-icon"><i class="fas fa-car"></i></div>
              <div class="dash-widget-info">
                <h6>Mobil</h6>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Page Content -->
@endsection
