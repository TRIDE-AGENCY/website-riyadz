<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light only">

    <title inertia>{{ $setting->site_title }}</title>
    <meta name="description" content="{{ $setting->meta_description }}">
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="author" content="Tride Agency">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $setting->og_title }}">
    <meta property="og:description" content="{{ $setting->og_description }}">
    <meta property="og:image" content="{{ $setting->og_image ? asset('storage/' . $setting->og_image) : asset('assets/media/logos/logo-og.jpg') }}">
    <meta property="og:url" content="{{ $setting->site_url }}">
    <meta property="og:locale" content="id_ID">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $setting->og_title }}">
    <meta name="twitter:description" content="{{ $setting->og_description }}">
    <meta name="twitter:image" content="{{ $setting->og_image ? asset('storage/' . $setting->og_image) : asset('assets/media/logos/logo-og.jpg') }}">
    <meta name="twitter:url" content="{{ $setting->site_url }}">

    <link rel="icon" href="{{ $setting->site_favicon ? asset('storage/' . $setting->site_favicon) : asset('assets/media/logos/logo-favicon.png') }}" type="image/png" />

    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    @if(isset($setting) && $setting->ga_measurement_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->ga_measurement_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $setting->ga_measurement_id }}');
        </script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>

<body>
    @inertia

    <!-- Scripts -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
