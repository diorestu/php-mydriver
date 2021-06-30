@extends('layouts.frontend')

@push('addon-style')
<style>
    .bg-lines{
        background-color: #e5e5f7;
        opacity: 0.8;
        background-image: repeating-radial-gradient( circle at 0 0, transparent 0, #e5e5f7 31px ), repeating-linear-gradient(
        #ffffff55, #ffffff );
    }
</style>
@laravelPWA
@endpush

@section('title')
    Login
@endsection

@section('content')
<div class="page no-navbar no-toolbar no-swipeback login-page login d-flex align-items-center vh100 bg-lines">
    <div class="page-content w-100">
        <div class="account-page">
            <div class="account-inner">
                <div class="account-center">
                    <div class="account-content">
                        <div class="account-logo">
                            <img alt="" src="{{ asset('frontend/img/logo-new.png') }}">
                        </div>
                        <div class="account-title m-0">
                            <h3><strong>Selamat Datang Di SID</strong>
                                <br>
                            </h3>
                            <p class="text-center mt-0 mb-3">SISTEM INFORMASI DRIVER BPD BALI</p>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-warning" role="alert">
                                <div class="text-center">{{ $errors->first() }}
                                </div>
                            </div>
                        @endif
                        <div class="account-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-list">
                                    {{-- <input type="text" placeholder="Username or Email"> --}}
                                    <input id="username" type="username"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username"
                                        placeholder="Nama Pengguna" autofocus>

                                    @error('username')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-list">
                                    {{-- <input type="password" placeholder="Password"> --}}
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Kata Sandi">
                                    @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-list">
                                    <button class="button account-btn btn w-100 py-3 rounded-lg">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center my-auto">
                        <a href="https://www.astapijar.id">Copyright &copy; 2021</br><strong>PT. Asta Pijar Kreasi Teknologi</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
