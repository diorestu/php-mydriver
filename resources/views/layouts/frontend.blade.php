<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- Web Application Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#000000">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="PWA">
    <link rel="icon" sizes="128x128" href="{{ asset('images/icons/128x128.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icons/512x512.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#3a57c4">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @laravelPWA
    <title>SID - @yield('title')</title>

    <!-- Bootstrap CSS -->
    @include('includes.frontend.style')
    @stack('addon-style')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&family=Poppins&family=Nunito&family=Inter:wght@200;300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
            font-weight: 100;
        }
        h1, h2, strong{
            font-family: 'Rubik';
            font-weight: 800;
        }
        p{
            font-family: 'Nunito';
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        @include('sweetalert::alert')
        <!-- Home -->
        <div class="home">
            {{-- Side Menu --}}
            @include('includes.frontend.header')
            @yield('content')
        </div>
        <!-- /Home -->
    </div>
    <!-- Main Wrapper /-->
    @include('includes.frontend.script')
    @stack('addon-script')
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
    </script>
</body>
</html>
