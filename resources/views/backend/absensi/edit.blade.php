@extends('layouts.backend')

@section('title')

@endsection


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Data Pengguna</h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <form method="post" action="{{ route('absensi.update', $staff->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Nama Driver : {{ $staff->user->name }}</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jam Hadir</label>
                                <input id="hadir" class="form-control" type="datetime-local" name="hadir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jam Pulang</label>
                                <input id="pulang" class="form-control" type="datetime-local" name="pulang">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imghdr">Foto Jam Hadir</label>
                                <input id="imghdr" class="form-control" type="file" name="img_hadir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imgplng">Foto Jam Pulang</label>
                                <input id="imgplng" class="form-control" type="file" name="img_pulang">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Latitude (Hadir)</label>
                                <input id="latlong" class="form-control" type="text" name="lat_hadir" value="{{ $staff->lat_hadir }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Longitude (Hadir)</label>
                                <input id="latlong" class="form-control" type="text" name="long_hadir" value="{{ $staff->long_hadir }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Latitude (Pulang)</label>
                                <input id="latlong" class="form-control" type="text" name="lat_pulang" value="{{ $staff->lat_pulang }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Longitude (Pulang)</label>
                                <input id="latlong" class="form-control" type="text" name="long_pulang" value="{{ $staff->long_pulang }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-textarea">Keterangan</label>
                                <textarea id="my-textarea" class="form-control" name="deskripsi" rows="3">{{ $staff->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block shadow-sm py-2" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
