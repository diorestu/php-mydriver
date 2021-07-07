@extends('layouts.frontend')

@section('title')
    Profil Pengguna
@endsection

@push('addon-style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endpush

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
<form method="POST" action="{{ route('profil.update', $data->id) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <!-- Page Content -->
    <div class="page-content mt-0">
        {{-- <div class="profile-header">
            <div class="pro-img-box">
                <img alt=""
                    src="{{ ($data->photos == null) ? asset('frontend/assets/img/user.jpg') : asset('storage/'.$data->photos)}}">
                <div class="pro-img-upload">
                    <input type="file" class="upload" name="photos">
                </div>
            </div>
            <div class="pro-user-det">
                <div class="profile-name">
                    <h2>{{ $data->name }}</h2>
                </div>
                <div class="profile-designation">
                    <h6>BPD Bali - {{ ($data->unitkerja == null) ? $data->cabang->cabang : $data->unitkerja->nama }}
                    </h6>
                </div>
            </div>
        </div> --}}
        <div class="container py-4">
            <div class="profile-header bg-light p-2">
                <div class="pro-img-box">
                    <img alt=""
                        src="{{ ($data->photos == null) ? asset('frontend/assets/img/user.jpg') : asset('storage/uploads/'.$data->photos)}}">
                    <div class="pro-img-upload">
                        <input type="file" class="upload" name="photos">
                    </div>
                </div>
                <p class="mt-2 mb-0 text-center text-dark">Klik Kamera untuk Upload Foto</p>
            </div>
            <div class="form-group">
                <label for="my-input">Nama Lengkap</label>
                <input id="my-input" class="form-control" type="text" name="name" value="{{ $data->name }}">
            </div>
            <div class="form-group">
                <label for="my-input">No. HP</label>
                <input id="my-input" class="form-control" type="text" name="phone" value="{{ $data->phone }}">
            </div>

            <div class="form-group">
                <label for="my-select">Lokasi Bertugas</label>
                <select id="my-select" class="form-control" name="id_cabang">
                    <option value="{{ $data->id_cabang }}">-- {{ $data->cabang->cabang }} --</option>
                    @foreach ($cabang as $item)
                    <option value="{{ $item->id }}">{{ $item->cabang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="my-select">Unit Penempatan</label>
                <select id="my-select" class="form-control" name="id_unit">
                    <option value="0">Tidak Ada Unit</option>
                    @foreach ($unit as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success btn-block py-3" type="submit">SIMPAN PROFIL SAYA</button>
        </div>
    </div>
</form>
@endsection

