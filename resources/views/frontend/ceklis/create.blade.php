@extends('layouts.frontend')

@section('title')
    Check List Harian Saya
@endsection

@section('content')
<div class="add-leave">
    <div class="navbar two-action no-hairline">
        <div class="navbar-inner d-flex align-items-center justify-content-between">
            <div class="left mr-0">
                <a href="{{ route('ceklis.index') }}" class="back link d-flex align-items-center">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="sliding custom-title">Input Check List Harian</div>
            <div class="right">
            </div>
        </div>
    </div>
    <div class="page-content mt-0">
        <div class="list no-hairlines custom-form">
            <div class="card-box">
                <ul class="no-border p-0">
                    @php
                        if(count($mobil) < 1){
                            echo '<div class="text-center">
                                <a href="'.route('car.create').'" class="badge badge-primary badge-pill px-4 py-2">Tambahkan Mobil
                                    Saya</a></div>';
                        }else{

                        }
                    @endphp

                    <form method="post" action="{{ route('ceklis.store') }}" enctype="multipart/form-data">
                        @csrf
                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Mobil</div>
                                <div class="item-input-wrap">

                                    <select class="form-control" name="id_mobil">
                                        @forelse ($mobil as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->plat }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </li>

                        <li class="item-content item-input">
                            <div class="item-inner d-flex align-items-center justify-content-between">
                                <div class="item-title">Kotak Tisu</div>
                                <div class="item-after">
                                    <label class="switch">
                                        <input type="checkbox" name="tisu">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li class="item-content item-input">
                            <div class="item-inner d-flex align-items-center justify-content-between">
                                <div class="item-title">Tempat Sampah</div>
                                <div class="item-after">
                                    <label class="switch">
                                        <input type="checkbox" name="box">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li class="item-content item-input">
                            <div class="item-inner d-flex align-items-center justify-content-between">
                                <div class="item-title">Masker</div>
                                <div class="item-after">
                                    <label class="switch">
                                        <input type="checkbox" name="masker">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li class="item-content item-input">
                            <div class="item-inner d-flex align-items-center justify-content-between">
                                <div class="item-title">Hand Sanitizer / Desinfektan</div>
                                <div class="item-after">
                                    <label class="switch">
                                        <input type="checkbox" name="sanitizer">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li class="item-content item-input">
                            <div class="item-inner d-flex align-items-center justify-content-between">
                                <div class="item-title">Pengharum Ruangan</div>
                                <div class="item-after">
                                    <label class="switch">
                                        <input type="checkbox" name="parfum">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li class="item-content item-input">
                            <div class="item-inner d-flex align-items-center justify-content-between">
                                <div class="item-title">Membersihkan Mobil <span class="text-danger"><em>*(Cuci/Lap/Semir Ban)</em></span></div>
                                <div class="item-after">
                                    <label class="switch">
                                        <input type="checkbox" name="washed">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li class="item-content item-input">
                            <div class="item-inner">
                                <div class="item-title item-label">Keterangan</div>
                                <div class="item-input-wrap">
                                    <textarea name="deskripsi"></textarea>
                                    <span class="input-clear-button"></span>
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
