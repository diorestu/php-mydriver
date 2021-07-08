@extends('layouts.frontend')

@section('title')
Absensi
@endsection

@push('addon-style')
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
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
        <div class="sliding custom-title">Absensi Pulang</div>
        <div class="right">
        </div>
    </div>
</div>
<div class="list no-hairlines custom-form m-0">
    <div class="card-box">
        <h6 class="text-center">Jam Hadir Anda : {{ \Carbon\Carbon::parse($data->hadir)->diffForHumans() }}</h6>
        <form method="POST" action="{{ route('absen.update', $id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <ul class="no-border pt-0 pb-4">
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
                            <input id="my-input" class="form-control-file" accept="image/*" accept="image/*;capture=camera" capture type="file" name="img_pulang">
                        </div>
                    </div>
                </li> --}}
                <li class="item-content item-input">
                  <div class="profile-header bg-light p-2 pt-3">
                    <div class="pro-img-box">
                      <img alt="" src="{{ asset('frontend/img/placeholder.png') }}">
                      <div class="pro-img-upload">
                        <input type="file" class="upload" name="img_pulang" onchange="readURL(this);">
                      </div>
                    </div>
                    <p class="mt-2 mb-0 text-center text-dark">Klik Kamera untuk Upload Foto</p>
                    <img id="blah" src="#" alt="Bukti Cuti Saya" class="" />
                  </div>
                </li>

                <li class="item-content item-input">
                    <div class="item-inner">
                        <div class="item-input-wrap">
                            <input id="lokasix" class="form-control" type="hidden" name="lat_pulang">
                            <input id="lokasiy" class="form-control" type="hidden" name="long_pulang">
                        </div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div id="demo"></div>
                    </div>
                </li>
            </ul>
            <div class="punch-btn">
                <button type="submit" class="button button-big button-purple py-4">Absen Pulang</button>
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
    x.value = position.coords.latitude;
    y.value = position.coords.longitude;
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                demo.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                demo.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                demo.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                demo.innerHTML = "An unknown error occurred."
                break;
        }
    }
</script>
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#blah')
          .attr('src', e.target.result)
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

</script>
@endpush

