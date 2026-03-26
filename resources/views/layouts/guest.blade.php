<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'THMC') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-slate-900 min-h-screen thmc-world-bg">
<div class="min-h-screen flex flex-col justify-center items-center px-4 py-8">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <a href="{{ route('store.index') }}" class="inline-flex flex-col items-center gap-3">
                <img src="{{ asset('images/thmc-logo-128.webp') }}" class="h-16 w-16 rounded-2xl shadow-sm" alt="THMC">
                <div>
                    <div class="font-extrabold text-slate-900 text-xl">THMC</div>
                    <div class="text-sm text-slate-600">Minecraft Store</div>
                </div>
            </a>
        </div>

        <div class="thmc-surface rounded-[2rem] px-6 py-6">
            {{ $slot }}
        </div>
    </div>
</div>
</body>
</html>
