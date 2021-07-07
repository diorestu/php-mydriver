@extends('layouts.backend')

@section('title')

@endsection

@push('addon-style')
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    var lat1 = @php echo $item->lat_hadir @endphp;
    var long1 = @php echo $item->long_hadir @endphp;
    function initialize() {
      var options = {
        center:new google.maps.LatLng(lat1, long1), // longitude latitude bandung
        zoom:17,
        mapTypeId:google.maps.MapTypeId.ROADMAP // Tipe ROADMAP
      };
      // create map object
      var map=new google.maps.Map(document.getElementById("googleMap"),options);
      var marker = new google.maps.Marker({
          position: new google.maps.LatLng(lat1, long1), // longitude latitude
          animation: google.maps.Animation.BOUNCE,
          map: map,
          title: 'Lokasi Absen Hadir'
      });
    }
    // membuat Event Listener untuk memanggil fungsi initialize pada saat halaman selesai di load
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
    var lat1 = @php echo $item->lat_pulang @endphp;
    var long1 = @php echo $item->long_pulang @endphp;
    function initialize() {
      var options = {
        center:new google.maps.LatLng(lat1, long1), // longitude latitude bandung
        zoom:17,
        mapTypeId:google.maps.MapTypeId.ROADMAP // Tipe ROADMAP
      };
      // create map object
      var map=new google.maps.Map(document.getElementById("googleMap2"),options);
      var marker = new google.maps.Marker({
          position: new google.maps.LatLng(lat1, long1), // longitude latitude
          animation: google.maps.Animation.BOUNCE,
          map: map,
          title: 'Lokasi Absen Hadir'
      });
    }
    // membuat Event Listener untuk memanggil fungsi initialize pada saat halaman selesai di load
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Absensi</h1>
</div>

<div class="card shadow">
    <div class="card-header">
        Detail Absen : {{ $item->user->name }}
    </div>
    <div class="card-body">
        <table class="table table-light">
            <tbody>
                <tr>
                    <td>Jam Hadir</td>
                    <td> : </td>
                    <td>{{ $item->hadir }}</td>
                </tr>
                <tr>
                    <td>Jam Pulang</td>
                    <td> : </td>
                    <td>{{ $item->pulang }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td> : </td>
                    <td>{{ $item->deskripsi }}</td>
                </tr>
            </tbody>
        </table>
        <div class="row mb-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Foto Absen Hadir</h6>
                        <div style="max-height:300px;" class="text-center">
                        <img height="200px" width="auto" src="{{ asset('storage/'.$item->img_hadir) }}" alt="Foto Hadir"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Foto Absen Pulang</h6>
                        <div style="max-height:300px;" class="text-center">
                        <img height="200px" width="auto" src="{{ asset('storage/'.$item->img_pulang) }}" alt="Foto Pulang"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Lokasi Kehadiran</h6>
                        <div id="googleMap" style="height:380px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Lokasi Absen Pulang</h6>
                        <div id="googleMap2" style="height:380px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
