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
</style>
<!-- Load google API -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
      var options = {
        center: new google.maps.LatLng(position.coords.latitude.toFixed(7), position.coords.longitude.toFixed(
        7)), // longitude latitude bandung
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP // Tipe ROADMAP
      };
      // create map object
      var map = new google.maps.Map(document.getElementById("googleMap"), options);
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(position.coords.latitude.toFixed(7), position.coords.longitude.toFixed(
        7)), // longitude latitude
        map: map,
        title: 'Bandung'
      });
    }
    // membuat Event Listener untuk memanggil fungsi initialize pada saat halaman selesai di load
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
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
        <div class="sliding custom-title">Absensi</div>
        <div class="right">
        </div>
    </div>
</div>
<div class="attendance-view">
    <div class="card-box pt-2">
        <div class="punch-head">
            <h2 class="attendance-title">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('LL') }}</h3>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="punch-widget">
                    <p>Jam Hadir</p>
                    @php
                    if ($absen != null) {
                    $hadir = Carbon\Carbon::parse($absen->hadir)->format('H:i');
                    } else {
                    $hadir = '--:--';
                    }
                    @endphp
                    <h2>{{ $hadir }}</h2>
                </div>
            </div>
            <div class="col-6">
                <div class="punch-widget">
                    <p>Jam Pulang</p>
                    @php
                    if ($absen != null) {
                    if ($absen->pulang) {
                    $pulang = Carbon\Carbon::parse($absen->pulang)->format('H:i');
                    } else {
                    $pulang = '--:--';
                    }
                    } else {
                    $pulang = '--:--';
                    }
                    @endphp
                    <h2>{{ $pulang }}</h2>

                </div>
            </div>
            <div>
            </div>
        </div>
        <div id="demo" class="text-center py-4 px-2 mb-3 mt-0" style="border-radius: 10px;"></div>
        <div id="googleMap" class="text-center py-4 " style="border-radius: 10px; height: 200px;"></div>

        @php
        if ($absen != null) {
        if ($pulang != '--:--') {
        echo "<h4 class='text-center'>Anda telah selesai bertugas, silakan beristirahat.</br> Terima Kasih</h4>";
        } else {
        echo "<a id='btn' href='" .
                    route('absen.edit', $absen->id) .
            "' class='btn btn-success btn-block my-2 py-3'
            type='button'>ABSEN
            PULANG</a>";
        }
        } else {
        echo "<a id='btn' href='" .
                route('absen.create') . "' class='btn btn-success btn-block my-2 py-3'
                    type='button'><b>ABSEN
                        HADIR</b></a>" ; } @endphp </div> </div> @php if ($data->unitkerja == null) {
            $lat = $data->cabang->lat;
            $long = $data->cabang->long;
            } else {
            $lat = $data->unitkerja->lat;
            $long = $data->unitkerja->long;
            }

            if ($data->pool == 3 || $data->pool == 4) {

            $radius = 500;
            } else {
            $radius = 250000;
            }

            @endphp
            @endsection

            @push('addon-script')
            <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true&v=3&libraries=geometry">
            </script>
            <script>
                var demo = document.getElementById("demo");
    var btn = document.getElementById("btn");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        demo.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
      var latitude1 = position.coords.latitude.toFixed(7);
      var longitude1 = position.coords.longitude.toFixed(7);
      // var latitude1 = @php echo -8.617584757395939; @endphp;
      // var longitude1 = @php echo 115.19258037236996; @endphp;
      var latitude2 = @php echo $data->cabang->lat; @endphp;
      var longitude2 = @php echo $data->cabang->long; @endphp;
      var radius = @php echo $radius; @endphp;
      var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(latitude1, longitude1),
        new google.maps.LatLng(latitude2.toFixed(6), longitude2.toFixed(7)));
      if (distance >= radius) {
        $("#btn").addClass("d-none");
        $("#demo").addClass("bg-gagal");
        demo.innerHTML = 'Maaf, Anda berada didalam radius <strong>' + distance.toFixed(1) +
          '</strong> meter. Mohon direfresh terlebih dulu';
      } else {
        $("#demo").addClass("bg-berhasil");
        demo.innerHTML = 'Mantap, Anda berada didalam radius <strong>' + distance.toFixed(1) +
          '</strong> meter. </br>Silahkan klik tombol <strong>Absen</strong>';
      }

      var options = {
        center: new google.maps.LatLng(position.coords.latitude.toFixed(7), position.coords.longitude.toFixed(
        7)), // longitude latitude bandung
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.ROADMAP // Tipe ROADMAP
      };
      // create map object
      var map = new google.maps.Map(document.getElementById("googleMap"), options);
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(position.coords.latitude.toFixed(7), position.coords.longitude.toFixed(
        7)), // longitude latitude
        map: map,
      });



    }
            </script>
            <script>
                window.onload(getLocation());
            </script>
            @endpush
            {{-- demo.innerHTML = 'Anda berada di <strong>' + latitude1 + ', '+ longitude1 +'</strong> dalam radius <strong>' +
    distance.toFixed(2) + '</> meter'; --}}
