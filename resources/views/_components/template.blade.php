<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @laravelPWA

    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/icons.min.css') }}">
    @yield('style')

</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Carregando...</span>
        </div>
    </div>

    <!-- Internet Connection Status -->
    <div class="internet-connection-status" id="internetStatus"></div>

    @yield('body')

    @include('_modais._modal_message')

    @include('_components.instalar_pwa')

    <script src="{{ mix('js/modules.min.js') }}"></script>

    <script src="{{ mix('js/app.min.js') }}"></script>

    @yield('script')
</body>

</html>
