<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

<meta name="title" content="GESTISS">
<meta name="author" content="Matheus Souza, Silvio Texeira, Matheus Ferreira">
<meta name="description" content="Sistema para controle e gestão da saúde pública">
<meta name="keywords" content="Sistema de Gestão, Saúde, SUS, prefeituras" />
<link rel="canonical" href="{{ env('APP_URL') }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- OG meta --}}
<meta property="og:type" content="website">
<meta property="og:locale" content="pt_BR">
<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:site_name" content="GESTISS">
<meta property="og:title" content="GESTISS">
<meta property="og:description" content="Sistema para controle e gestão da saúde pública">
<meta property="og:image" content="{{ asset('images/icon.svg') }}" />
<meta name="format-detection" content="telephone=no">

{{-- Favicons Icon --}}
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icon.svg') }}" />

{{-- Web Application Manifest --}}
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">
{{-- Chrome for Android theme color --}}
<meta name="theme-color" content="{{ $config['theme_color'] }}">

{{-- Add to homescreen for Chrome on Android --}}
<meta name="mobile-web-app-capable" content="{{ $config['display'] == 'standalone' ? 'yes' : 'no' }}">
<meta name="application-name" content="{{ $config['short_name'] }}">
<link rel="icon" sizes="{{ data_get(end($config['icons']), 'sizes') }}"
    href="{{ data_get(end($config['icons']), 'src') }}">

{{-- Add to homescreen for Safari on iOS --}}
<meta name="apple-mobile-web-app-capable" content="{{ $config['display'] == 'standalone' ? 'yes' : 'no' }}">
<meta name="apple-mobile-web-app-status-bar-style" content="{{ $config['status_bar'] }}">
<meta name="apple-mobile-web-app-title" content="{{ $config['short_name'] }}">
<link rel="apple-touch-icon" href="{{ data_get(end($config['icons']), 'src') }}">


<link href="{{ $config['splash']['640x1136'] }}"
    media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['750x1334'] }}"
    media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1242x2208'] }}"
    media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1125x2436'] }}"
    media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['828x1792'] }}"
    media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1242x2688'] }}"
    media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1536x2048'] }}"
    media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1668x2224'] }}"
    media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1668x2388'] }}"
    media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2048x2732'] }}"
    media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />

{{-- Tile for Win8 --}}
<meta name="msapplication-TileColor" content="{{ $config['background_color'] }}">
<meta name="msapplication-TileImage" content="{{ data_get(end($config['icons']), 'src') }}">

<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function(registration) {
            // Registration was successful
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
</script>
