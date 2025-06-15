<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('components.cpmi.header')
    <main>
        @yield('main')
    </main>
    @include('components.cpmi.footer')
    @vite($jsFile ?? [])
</body>
</html>