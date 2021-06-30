@extends('layouts.frontend')

@section('title')
Tambah Cuti
@endsection

@section('content')
<div class="add-leave">

    <!-- Header -->
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('bensin.index') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="sliding custom-title">Riwayat Pembelian Bahan Bakar</div>
            <div class="right">
            </div>
        </div>
    </div>
    <!-- /Header -->

    <div class="page-content">

        <div class="list no-hairlines custom-form">
            <div class="card-box">

                <ul class="no-border pt-0 pb-0">
                    <form method="post" action="{{ route('bensin.store') }}" enctype="multipart/form-data">
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
                                <div class="item-title item-label">Jumlah Pembelian</div>
                                <div class="item-input-wrap">
                                    <input class="form-control" type="number" name="harga">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Kilometer Saat Pembelian</div>
                                <div class="item-input-wrap">
                                    <input class="form-control" type="number" name="km">
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Keterangan</div>
                                <div class="item-input-wrap">
                                    <textarea id="my-textarea" class="form-control" name="keterangan" rows="3"></textarea>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Gambar Pendukung</div>
                                <div class="item-input-wrap">
                                    <input id="my-input" class="form-control-file" accept="image/*" accept="image/*;capture=camera" capture
                                        type="file" name="photos">
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

