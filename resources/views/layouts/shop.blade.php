<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('shop.partials.header')
    
    <main>
        @yield('content')
    </main>

    @include('shop.partials.footer')
</body>
</html> 