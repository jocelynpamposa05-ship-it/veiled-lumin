<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Veiled Lumin') }}</title>

        {{-- Fonts: Inter (UI) + Fraunces (wordmark) --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-parchment antialiased bg-ink min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        {{-- Wordmark --}}
        <div class="mb-6">
            <a href="/" class="font-serif text-2xl text-parchment hover:text-amber-glow transition duration-200 tracking-wide">
                Veiled Lumin
            </a>
        </div>

        {{-- Card --}}
        <div class="w-full sm:max-w-md px-6 py-8
                    bg-white/[0.05] border border-white/10 rounded-xl
                    shadow-[0_8px_40px_rgba(0,0,0,0.5)]">
            {{ $slot }}
        </div>

        {{-- Back to site --}}
        <div class="mt-6 text-xs text-lavender-grey/60">
            <a href="{{ route('home') }}" class="hover:text-lavender-grey transition duration-150">&larr; Back to site</a>
        </div>

    </body>
</html>
