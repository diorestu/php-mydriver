@extends('layouts.frontend')

@section('title')
Tambah Mobil
@endsection

@section('content')
<div class="add-leave">

    <!-- Header -->
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('ceklis.index') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="sliding custom-title">Input Data Mobil</div>
            <div class="right">
            </div>
        </div>
    </div>
    <!-- /Header -->

    <div class="page-content">

        <div class="list no-hairlines custom-form">
            <div class="card-box">
                <ul class="no-border pt-0 pb-0">
                    <form method="post" action="{{ route('car.store') }}" enctype="multipart/form-data">
                        @csrf
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Nama & Merk Mobil</div>
                                <div class="item-input-wrap">
                                    <input class="form-control" type="text" name="nama">
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Plat Nomor <span class="text-danger"><em>*Menggunakan Huruf Kapital</em></span></div>
                                <div class="item-input-wrap">
                                    <input type="text" class="form-control" name="plat">
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Jenis Mobil</div>
                                <div class="item-input-wrap">
                                    <select class="form-control" name="tipe">
                                        <option value="Direksi">Mobil Direksi / Komisaris</option>
                                        <option value="Operasional">Mobil Operasional</option>
                                        <option value="Pelayanan">Mobil Pelayanan</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Kilometer Mobil Saat Ini</div>
                                <div class="item-input-wrap">
                                    <input type="number" class="form-control" name="km">
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Foto Pendukung</div>
                                <div class="item-input-wrap">
                                    <input type="file" class="form-control" name="photos">
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-input-wrap">
                                    <button type="submit" class="button button-big button-purple py-3">
                                        Simpan</button>
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
