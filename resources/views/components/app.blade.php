<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- - token de laravel para verificar usuarios- --}}

	{{-- Titulo dinámico que se pasa desde una vista --}}
    <title>{{ $title ?? 'Biblioteca' }}</title> {{-- - Nombre de la aplicación - --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    {{-- - Menu, Se puede de las dos nomenclaturas, con include o con la nueva. - --}}
    {{-- @include('components.menu') --}}
    <x-menu />

    {{-- - Content - --}}
    <main id="app">
        {{ $slot }}
    </main>
</body>

</html>
