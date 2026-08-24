<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin — Veiled Lumin')</title>

    {{-- Fonts: Inter (UI) + Fraunces (poetry / wordmark) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;1,9..144,300;1,9..144,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <x-vite-assets />
</head>
<body class="font-sans bg-stone-100 text-stone-800 antialiased">
<div class="flex min-h-screen">

    {{-- ── Sidebar ──────────────────────────────────────────────────────────── --}}
    <aside class="w-56 bg-ink flex flex-col flex-shrink-0">

        {{-- Wordmark --}}
        <div class="px-6 py-5 border-b border-white/10">
            <a href="{{ route('home') }}" class="font-serif text-base text-parchment tracking-wide hover:text-amber-glow transition duration-150">
                Veiled Lumin
            </a>
            <div class="text-[10px] text-lavender-grey/60 mt-0.5 font-sans uppercase tracking-widest">Admin</div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-5 space-y-0.5 text-sm">
            @php
                // $indexRoute  = the named route used for href generation (must exist)
                // $matchPrefix = the prefix passed to routeIs() for active-state detection
                $navLink = fn(string $indexRoute, string $matchPrefix, string $label) =>
                    '<a href="' . route($indexRoute) . '" class="flex items-center gap-2 px-3 py-2 rounded-md transition duration-150 ' .
                    (request()->routeIs($matchPrefix . '*')
                        ? 'bg-amber-glow/15 text-amber-glow font-medium'
                        : 'text-lavender-grey hover:bg-white/6 hover:text-parchment') .
                    '">' . $label . '</a>';
            @endphp

            {!! $navLink('admin.dashboard', 'admin.dashboard', 'Dashboard') !!}
            {!! $navLink('admin.poems.index', 'admin.poems.', 'Poems') !!}
            {!! $navLink('admin.genres.index', 'admin.genres.', 'Genres') !!}
        </nav>

        {{-- Footer links --}}
        <div class="px-3 py-4 border-t border-white/10 space-y-0.5 text-sm">
            <a href="{{ route('home') }}"
               class="flex items-center gap-1.5 px-3 py-2 rounded-md text-lavender-grey/70 hover:text-parchment hover:bg-white/6 transition duration-150">
                View site
                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 7l-10 10M17 7H7m10 0v10"/>
                </svg>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left flex items-center gap-2 px-3 py-2 rounded-md text-lavender-grey/70 hover:text-parchment hover:bg-white/6 transition duration-150">
                    Log out
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main area ────────────────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Top bar --}}
        <header class="bg-white border-b border-stone-200 px-8 py-4 flex items-center justify-between">
            <h1 class="font-serif text-lg text-stone-800">@yield('page-title', 'Dashboard')</h1>
            <span class="text-xs text-stone-400 font-sans">{{ Auth::user()?->name }}</span>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-8 bg-stone-100">
            @if(session('status'))
                <div class="mb-6 rounded-md bg-green-50 text-green-700 text-sm px-4 py-3 border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</div>

@stack('scripts')
</body>
</html>
