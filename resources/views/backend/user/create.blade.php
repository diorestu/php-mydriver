@extends('layouts.backend')

@section('title')

@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Pengguna</h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">No. HP</label>
                                <input id="name" class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="form-group">
                                <label for="my-select">Status</label>
                                <select id="my-select" class="form-control" name="roles">
                                    <option value="1">Administrator</option>
                                    <option value="2">Pengawas</option>
                                    <option value="3">Operasional Cabang</option>
                                    <option value="4">Driver</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" class="form-control" type="text" name="username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password-confirm" class="text-md-right">Ulangi Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-12">
                            <div class="form-group">
                                <label for="my-select">Kantor Cabang</label>
                                <select id="my-select" class="form-control" name="id_cabang">
                                    @forelse ($cabang as $item)
                                    <option value="{{ $item->id }}">{{ $item->cabang }}</option>
                                    @empty
                                    <option value="0">Tidak Ada Cabang</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="form-group">
                                <label for="my-select">Unit Kerja</label>
                                <select id="my-select" class="form-control" name="id_unit">
                                    @forelse ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @empty
                                    <option value="0">Tidak Ada Unit</option>
                                    @endforelse
                                </select>
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

