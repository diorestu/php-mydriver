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
    <div class="profile-header">
        <div class="pro-img-box">
            {{-- <img alt="" src="frontend/assets/img/user.jpg"> --}}
            <img alt=""
                src="{{ ($data->photos == null) ? asset('frontend/assets/img/user.jpg') : asset('storage/'.$data->photos)}}">
            {{-- <div class="pro-img-upload">
                <input type="file" class="upload">
            </div> --}}
        </div>
        <div class="pro-user-det">
            <div class="profile-name">
                <h2>{{ $data->name }}</h2>
            </div>
            <div class="profile-designation">
                <h6>BPD Bali - {{ ($data->unitkerja == null) ? $data->cabang->cabang : $data->unitkerja->nama }}</h6>
            </div>
        </div>
    </div>
    <div class="card-box mb-0">
        <div class="punch-head">
            <h4 class="attendance-title" style="font-size: 20px;">
                {{ Carbon\Carbon::now()->locale('id')->isoFormat('dddd, LL') }}</h4>
        </div>
        <div class="row">
            <div class="col-6">
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
                    <p>Jam Hadir</p>
                </div>
            </div>
            <div class="col-6">
                <div class="punch-widget">
                    <h2><strong>{{ $pulang }}</strong></h2>
                    <p>Jam Pulang</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="dash-widget pt-1">
            <div class="dash-widget-info">

                @php
                if($aktivitas != null){
                    echo '<h5>'.$aktivitas->customer.'</h5>';
                    echo '<p>'. $aktivitas->deskripsi .'</p>';
                    echo    '<ul class="list-inline mt-2">
                                <li class="list-inline-item">
                                    <a href="'.route('aktivitas.edit', $aktivitas->id).'"><span class="badge badge-pill badge-primary px-3 py-2">Selesaikan Tugas</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="tel:'.$aktivitas->cust_phone.'"><span
                                        class="badge badge-pill badge-success px-3 py-2">Hubungi User</span>
                                    </a>
                                </li>
                            </ul>';
                }else{
                echo '<h5>Tidak Ada Aktivitas Terbaru</h5>';
                }
                @endphp
            </div>
        </div>
        <div class="dashboard-area mt-4">
            <h5 class="mt-2">Menu</h5>
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
                            <div class="dash-widget-icon"><i class="fas fa-car"></i></div>
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
                {{-- <div class="col-6 pl-2">
                    <a href="{{ route('overtime.index') }}">
                <div class="dash-widget pb-0">
                    <div class="dash-widget-icon"><i class="fas fa-clock"></i></div>
                    <div class="dash-widget-info">
                        <h6>Lembur</h6>
                    </div>
                </div>
                </a>
            </div> --}}
        </div>
    </div>
</div>
</div>
<!-- /Page Content -->
@endsection
