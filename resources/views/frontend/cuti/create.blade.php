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
                <a href="{{ route('cuti.index') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="sliding custom-title">Pengajuan Cuti</div>
            <div class="right">
            </div>
        </div>
    </div>
    <!-- /Header -->

    <div class="page-content">

        <div class="list no-hairlines custom-form">
            <div class="card-box">

                <ul class="no-border pt-0 pb-0">
                    <form method="post" action="{{ route('cuti.store') }}" enctype="multipart/form-data">
                        @csrf
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Alasan Cuti / Ijin</div>
                                <div class="item-input-wrap">
                                    <select class="form-control" name="tipe">
                                        <option value="Cuti">Cuti</option>
                                        <option value="Ijin/Sakit">Ijin Sakit</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Tanggal Mulai</div>
                                <div class="item-input-wrap">
                                    <input type="date" class="form-control date" name="mulai">
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Tanggal Selesai</div>
                                <div class="item-input-wrap">
                                    <input type="date" class="form-control date" name="selesai">
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Keterangan Cuti / Ijin</div>
                                <div class="item-input-wrap">
                                    <textarea name="deskripsi"></textarea>
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-input-wrap">
                                    <button type="submit" class="button button-big button-purple py-3">Kirim
                                        Pengajuan</button>
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

