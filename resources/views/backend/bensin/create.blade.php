@extends('layouts.backend')

@section('title')
    Tambah BBM
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Pengisian Bahan Bakar</h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <form method="post" action="{{ route('bbm.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Driver</label>
                                {{-- <input id="name" class="form-control" type="text" name="name"> --}}
                                <select id="my-select" class="form-control" name="id_user">
                                    @foreach ($staff as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Mobil yang Digunakan</label>
                                <select id="my-select" class="form-control" name="id_mobil">
                                    @foreach ($mobil as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama}} - {{ $item->plat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Tanggal Pembelian</label>
                                <input class="form-control" type="date" name="tanggal">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Jumlah Pembelian</label>
                                <input class="form-control" type="number" name="harga">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Kilometer Saat Pembelian</label>
                                <input class="form-control" type="number" name="km">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Foto Bukti Pembelian</label>
                                <input class="form-control" type="file" name="photos">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-textarea">Keterangan Pembelian</label>
                                <textarea id="my-textarea" class="form-control" name="keterangan" rows="3"></textarea>
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

