@extends('layouts.frontend')

@section('title')
    Tambah Aktivitas
@endsection

@section('content')
<div class="add-leave">
    <!-- Header -->
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('aktivitas.index') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="sliding custom-title">Tambah Aktivitas</div>
            <div class="right">
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="list no-hairlines custom-form">
            <div class="card-box">
                <ul class="no-border pt-0 pb-0">
                    <form method="post" action="{{ route('aktivitas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Mobil</div>
                                <div class="item-input-wrap">
                                    <select id="my-select" class="form-control" name="id_mobil">
                                        @foreach ($mobil as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama}} - {{ $item->plat }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Nama Penumpang</div>
                                <div class="item-input-wrap">
                                    <input class="form-control" type="text" name="customer">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Keterangan Kegiatan</div>
                                <div class="item-input-wrap">
                                    <textarea id="my-textarea" class="form-control" name="deskripsi" rows="4" required></textarea>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Kilometer Awal Kegiatan</div>
                                <div class="item-input-wrap">
                                    <input class="form-control" type="number" name="km_awal">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Kilometer Akhir Kegiatan</div>
                                <div class="item-input-wrap">
                                    <input class="form-control" type="number" name="km_akhir">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Foto Pendukung</div>
                                <div class="item-input-wrap">
                                    <input id="my-input" class="form-control-file" accept="image/*" accept="image/*;capture=camera" capture type="file"
                                        name="photo">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-input-wrap">
                                    <input type="hidden" name="lat" value="" id="lokasix">
                                    <input type="hidden" name="long" value="" id="lokasiy">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-input-wrap">
                                    <button type="submit" class="button button-big button-purple py-3">Simpan</button>
                                </div>
                            </div>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
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
    x.value = position.coords.latitude.toFixed(8);
    y.value = position.coords.longitude.toFixed(8);
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
@endpush
