@extends('layouts.frontend')

@section('title')
Tambah Cuti
@endsection

@push('addon-style')
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
@endpush

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
                                    <select class="form-control" name="tipe" required>
                                        <option value="Cuti">Cuti</option>
                                        <option value="Ijin">Ijin</option>
                                        <option value="Sakit">Sakit</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="row">
                                <div class="col-6">
                                    <div class="item-inner">
                                      <div class="item-title item-label">Tanggal Mulai</div>
                                      <div class="item-input-wrap">
                                        <input type="date" class="form-control date" name="mulai" required>
                                        <span class="input-clear-button"></span>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-inner">
                                      <div class="item-title item-label">Tanggal Selesai</div>
                                      <div class="item-input-wrap">
                                        <input type="date" class="form-control date" name="selesai" required>
                                        <span class="input-clear-button"></span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Keterangan Cuti / Ijin</div>
                                <div class="item-input-wrap">
                                    <textarea name="deskripsi" required></textarea>
                                    <span class="input-clear-button"></span>
                                </div>
                            </div>
                        </li>
                        <li class="item-content item-input">
                          <div class="profile-header bg-light p-2 pt-3">
                            <div class="pro-img-box">
                              <img alt="" src="{{ asset('frontend/img/placeholder.png') }}">
                              <div class="pro-img-upload">
                                <input type="file" class="upload" name="photos" onchange="readURL(this);">
                              </div>
                            </div>
                            <p class="mt-2 mb-0 text-center text-dark">Klik Kamera untuk Upload Foto</p>
                            <img id="blah" src="#" alt="Bukti Cuti Saya" class="" />
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

@push('addon-script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                    .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
