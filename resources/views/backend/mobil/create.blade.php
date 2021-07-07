@extends('layouts.backend')

@section('title')
    Tambah Mobil
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Mobil</h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <form method="post" action="{{ route('task.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Identitas Diri<span class="text-danger"><em> *Mohon tulis nama beserta divisi</em></span></label>
                                <input id="name" class="form-control" type="text" name="customer">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Tanggal Order</label>
                                <input class="form-control" type="date" name="tanggal">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-textarea">Keterangan Keperluan</label>
                                <textarea id="my-textarea" class="form-control" name="deskripsi" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-select">Inventaris Cabang</label>
                                <select id="my-select" class="form-control" name="">
                                    @foreach ($cabang as $item)
                                    <option value=""></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success btn-block shadow-sm py-3" type="submit">ORDER</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

