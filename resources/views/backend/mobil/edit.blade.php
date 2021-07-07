@extends('layouts.backend')

@section('title')
Review
@endsection


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Review Perjalanan Anda</h1>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <form class="rating" method="post" action="{{ route('task.update', $data->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-select">Kualitas Pelayanan</label>
                                <select id="my-select" class="custom-select" name="rating" >
                                    <option value="1">Tidak Baik</option>
                                    <option value="2">Cukup Baik</option>
                                    <option value="3">Baik</option>
                                    <option value="4">Sangat Baik</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="my-textarea">Komentar</label>
                                <textarea id="my-textarea" class="form-control" name="komentar" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <button class="btn btn-primary btn-block shadow-sm py-2" type="submit">Beri Rating</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
