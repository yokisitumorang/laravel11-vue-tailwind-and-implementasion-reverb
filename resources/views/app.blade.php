<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @routes
    {{-- <link href="{{ vite_asset('public\build\assets\app-CBm0KfsU.css') }}" rel="stylesheet"> --}}
    
    {{-- when use npm run dev enable this, after build, comment this --}}
    {{-- @vite('resources/css/app.css') --}}

    @vite('resources/js/app.js') 
    {{-- <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <script src="{{ asset(mix('js/manifest.js')) }}" defer></script>
    <script src="{{ asset(mix('js/vendor.js')) }}" defer></script>
    <script src="{{ asset(mix('js/app.js')) }}" defer></script> --}}
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
