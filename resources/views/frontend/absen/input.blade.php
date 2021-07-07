@extends('layouts.frontend')

@section('title')
Absensi
@endsection

@push('addon-style')
<style>
    .bg-berhasil {
        background: #F0FFF0;
    }

    .bg-gagal {
        background: #FFE4E1;
    }
    .Neon {
    font-family: sans-serif;
    font-size: 14px;
    color: #494949;
    position: relative;


    }
    .Neon * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    }
    .Neon-input-dragDrop {
    display: block;
    width: 343px;
    margin: 0 auto 25px auto;
    padding: 25px;
    color: #8d9499;
    color: #97A1A8;
    background: #fff;
    border: 2px dashed #C8CBCE;
    text-align: center;
    -webkit-transition: box-shadow 0.3s, border-color 0.3s;
    -moz-transition: box-shadow 0.3s, border-color 0.3s;
    transition: box-shadow 0.3s, border-color 0.3s;
    }
    .Neon-input-dragDrop .Neon-input-icon {
    font-size: 48px;
    margin-top: -10px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;
    }
    .Neon-input-text h3 {
    margin: 0;
    font-size: 18px;
    }
    .Neon-input-text span {
    font-size: 12px;
    }
    .Neon-input-choose-btn.blue {
    color: #008BFF;
    border: 1px solid #008BFF;
    }
    .Neon-input-choose-btn {
    display: inline-block;
    padding: 8px 14px;
    outline: none;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
    font-size: 12px;
    font-weight: bold;
    color: #8d9496;
    border-radius: 3px;
    border: 1px solid #c6c6c6;
    vertical-align: middle;
    background-color: #fff;
    box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
    -webkit-transition: all 0.2s;
    -moz-transition: all 0.2s;
    transition: all 0.2s;
    }
</style>
@endpush

@section('content')
{{-- <div class="page-content"> --}}
<div class="navbar two-action no-hairline">
    <div class="navbar-inner d-flex align-items-center justify-content-between">
        <div class="left mr-0">
            <a href="{{ route('beranda') }}" class="back link d-flex align-items-center">
                <i class="fas fa-arrow-left"></i>
                {{-- <span>Kembali</span> --}}
            </a>
        </div>
        <div class="sliding custom-title">Absensi Datang</div>
        <div class="right">
        </div>
    </div>
</div>
<div class="list no-hairlines custom-form m-0">
    <div class="card-box">
        <form method="POST" action="{{ route('absen.store') }}" enctype="multipart/form-data">
            @csrf
            <ul class="no-border p-0 m-0">
                <li class="item-content">
                    <div class="item-inner">
                        <div id="demo" class="text-center"></div>
                    </div>
                </li>
                <li class="item-content item-input">
                    <div class="item-inner">
                        <div class="item-title item-label">Keterangan</div>
                        <div class="item-input-wrap">
                            <textarea name="deskripsi"></textarea>
                            <span class="input-clear-button"></span>
                        </div>
                    </div>
                </li>
                {{-- <li class="item-content item-input">
                    <div class="item-inner">
                        <div class="item-title item-label">Gambar Pendukung</div>
                        <div class="item-input-wrap">
                            <input id="my-input" class="form-control-file" accept="image/*" accept="image/*;capture=camera" capture type="file" name="img_hadir">
                        </div>
                    </div>
                </li> --}}
                <li class="item-content item-input">
                    <div class="profile-header bg-light p-2">
                        <div class="pro-img-box">
                            <img alt=""
                                src="{{ asset('frontend/img/placeholder.png') }}">
                            <div class="pro-img-upload">
                                <input type="file" class="upload" name="img_hadir">
                            </div>
                        </div>
                        <p class="mt-2 mb-0 text-center text-dark">Klik Kamera untuk Upload Foto</p>
                    </div>
                </li>
                <li class="item-content item-input">
                    <div class="item-inner">
                        <div class="item-input-wrap">
                            <input id="lokasix" class="form-control" type="hidden" name="lat_hadir">
                            <input id="lokasiy" class="form-control" type="hidden" name="long_hadir">
                        </div>
                    </div>
                </li>
            </ul>
            <div class="punch-btn">
                <button type="submit" class="button button-big button-purple py-4">Absen</button>
            </div>
        </form>

    </div>
</div>
{{-- </div> --}}
@endsection

@push('addon-script')

<script>
    var demo = document.getElementById("demo");
    var x = document.getElementById("lokasix");
    var y = document.getElementById("lokasiy");

    window.onload(getLocation());

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            demo.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
    x.value = position.coords.latitude.toFixed(7);
    y.value = position.coords.longitude.toFixed(8);
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                demo.innerHTML = "Geolocation ditolak oleh pengguna"
                $("#demo").addClass("bg-gagal py-4");
                break;
            case error.POSITION_UNAVAILABLE:
                demo.innerHTML = "Data lokasi tidak tersedia, mohon hidupkan akses GPS Anda."
                break;
            case error.TIMEOUT:
                demo.innerHTML = "Mohon periksa ulang Jaringan Internet Anda"
                break;
            case error.UNKNOWN_ERROR:
                demo.innerHTML = "Unknown Error : Mohon periksa kembali koneksi dan setelan perangkat."
                break;
        }
    }

</script>


@endpush
