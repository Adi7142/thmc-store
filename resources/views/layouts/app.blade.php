<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'THMC') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    x-data="{ cartOpen: false }"
    @open-cart.window="cartOpen = true"
    @keydown.escape.window="cartOpen = false"
    class="antialiased text-slate-900 min-h-screen thmc-world-bg"
>
<div class="min-h-screen">
    @include('layouts.navigation')

    @isset($header)
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            <div class="thmc-surface rounded-3xl px-6 py-5">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    @include('store.partials.cart-drawer')

    <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 pt-4">
        <div class="thmc-surface rounded-3xl px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-3 text-sm">
            <div class="text-slate-600">© {{ date('Y') }} THMC — All rights reserved.</div>
            <div class="flex items-center gap-2 text-slate-600">
                <span>Server IP:</span>
                <span class="font-semibold text-slate-900">play.yourserver.com</span>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
