@extends('layouts.backend')

@section('title')
    Tambah Absensi
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Absensi</h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <form method="post" action="{{ route('absensi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Driver</label>
                                {{-- <input id="name" class="form-control" type="text" name="name"> --}}
                                <select id="my-select" class="form-control" name="name">
                                    @foreach ($staff as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jam Hadir</label>
                                <input id="name" class="form-control" type="datetime-local" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Jam Pulang</label>
                                <input id="name" class="form-control" type="datetime-local" name="phone">
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
                                <input id="name" class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Longitude (Hadir)</label>
                                <input id="name" class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Latitude (Pulang)</label>
                                <input id="name" class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Longitude (Pulang)</label>
                                <input id="name" class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-textarea">Keterangan</label>
                                <textarea id="my-textarea" class="form-control" name="deskripsi" rows="3"></textarea>
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

