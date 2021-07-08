<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- Web Application Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#316900">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="SID">
    <link rel="icon" sizes="128x128" href="{{ asset('images/icons/128x128.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icons/512x512.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Brew">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icons/152x152.png') }}" type="image/png">
    <link rel="mask-icon" href="{{ asset('images/icons/128x128.png') }}" color="#316900">

    <script async src="https://unpkg.com/pwacompat" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @laravelPWA
    <title>SID - @yield('title')</title>

    <!-- Bootstrap CSS -->
    @include('includes.frontend.style')
    @stack('addon-style')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Nunito&family=Inter:wght@200;300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
            font-weight: 100;
        }
        h1, h2, strong{
            font-family: 'Nunito';
            font-weight: 800;
        }
        p{
            font-family: 'Montserrat';
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('sweetalert::alert')
        <!-- Home -->
        @include('includes.frontend.header')
        {{-- <div class="home">
            <nav class="navbar navbar-dark bg-success navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom">
                <ul class="navbar-nav nav-justified w-100">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Cari</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Add</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Notif</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Profile</a>
                    </li>
                </ul>
            </nav> --}}
            {{-- Side Menu --}}
            {{-- @include('includes.frontend.header') --}}
            @yield('content')
        </div>
        <!-- /Home -->
    </div>
    <!-- Main Wrapper /-->
    @include('includes.frontend.script')
    @stack('addon-script')
    <script>
        window.onload(
            window.addEventListener('load', function() {
            window.history.pushState({}, '')
            })

            window.addEventListener('popstate', function() {
            window.history.pushState({}, '')
            })
        );
    </script>
    <script>
        if ('serviceWorker' in navigator && 'PushManager' in window) {
            console.log('Service Worker and Push is supported');

            navigator.serviceWorker.register('serviceworker.js')
                .then(function(swReg) {
                    console.log('Service Worker is registered', swReg);
                    swRegistration = swReg;
                })
            .catch(function(error) {
            console.error('Service Worker Error', error);
            });
        } else {
            console.warn('Push messaging is not supported');
            pushButton.textContent = 'Push Not Supported';
        }

        var backPresses = 0;
        var isAndroid = navigator.userAgent.toLowerCase().indexOf("android") > -1;
        var maxBackPresses = 2;

        function handleBackButton(init) {
            if (init !== true)
                backPresses++;
            if ((!isAndroid && backPresses >= maxBackPresses) ||
                (isAndroid && backPresses >= maxBackPresses - 1)) {
                window.history.back();
            else
                window.history.pushState({}, '');
            }

        function setupWindowHistoryTricks() {
            handleBackButton(true);
            window.addEventListener('popstate', handleBackButton);
        }

    </script>
</body>
</html>
