<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Veiled Lumin')</title>

    {{-- Fonts: Inter (UI) + Fraunces (poetry) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;1,9..144,300;1,9..144,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/build/assets/app-CS3g80mm.css">
    <script type="module" src="/build/assets/app-_swCgE72.js"></script>
</head>
<body class="font-sans bg-ink text-parchment antialiased min-h-full flex flex-col">

    {{-- ── Header ──────────────────────────────────────────────────────────── --}}
    <header class="sticky top-0 z-50 border-b border-white/8 bg-ink/90 backdrop-blur-md">
        <div class="max-w-5xl mx-auto px-6 py-5 flex items-center justify-between">

            {{-- Wordmark --}}
            <a href="{{ route('home') }}"
               class="font-serif text-xl tracking-wide text-parchment hover:text-amber-glow transition duration-200 flex items-center gap-2">
                {{-- Subtle glow dot --}}
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-amber-glow/70 shadow-[0_0_6px_2px_rgba(233,183,103,0.5)]"></span>
                Veiled Lumin
            </a>

            {{-- Desktop nav --}}
            <nav class="hidden sm:flex items-center gap-1 text-sm" aria-label="Main navigation">
                @php
                    $navItems = [
                        ['Home',   route('home'),          'home'],
                        ['Poems',  route('poems.index'),   'poems.*'],
                        ['Genres', route('genres.index'),  'genres.*'],
                        ['About',  route('about'),         'about'],
                    ];
                @endphp
                @foreach($navItems as [$label, $href, $pattern])
                    @php $active = request()->routeIs($pattern); @endphp
                    <a href="{{ $href }}"
                       class="relative px-3 py-1.5 rounded transition duration-150
                              {{ $active
                                  ? 'text-parchment'
                                  : 'text-lavender-grey hover:text-parchment' }}">
                        {{ $label }}
                        @if($active)
                            <span class="absolute bottom-0 left-3 right-3 h-px bg-amber-glow/70 rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </nav>

            {{-- Mobile hamburger (Alpine) --}}
            <button class="sm:hidden text-lavender-grey hover:text-parchment transition"
                    x-data
                    @click="$dispatch('toggle-mobile-nav')"
                    aria-label="Toggle menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile nav drawer --}}
        <div x-data="{ open: false }"
             @toggle-mobile-nav.window="open = !open"
             x-show="open"
             x-transition:enter="transition duration-150"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition duration-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="sm:hidden border-t border-white/8 bg-ink/95 backdrop-blur-md px-6 py-4 space-y-1">
            @foreach($navItems as [$label, $href, $pattern])
                @php $active = request()->routeIs($pattern); @endphp
                <a href="{{ $href }}"
                   class="block py-2 text-sm {{ $active ? 'text-parchment' : 'text-lavender-grey' }}">
                    {{ $label }}
                    @if($active)<span class="ml-1.5 text-amber-glow">·</span>@endif
                </a>
            @endforeach
        </div>
    </header>

    {{-- ── Page content ─────────────────────────────────────────────────────── --}}
    <main class="flex-1 w-full @yield('main-class', 'max-w-5xl mx-auto px-6 py-14')">
        @yield('content')
    </main>

    {{-- ── Footer ───────────────────────────────────────────────────────────── --}}
    <footer class="border-t border-white/8 mt-auto">
        <div class="max-w-5xl mx-auto px-6 py-12">
            <div class="flex flex-col items-center gap-4 text-center">

                {{-- Wordmark --}}
                <a href="{{ route('home') }}" class="font-serif text-lg text-parchment/80 hover:text-amber-glow transition duration-200 flex items-center gap-2">
                    <span class="inline-block w-1 h-1 rounded-full bg-amber-glow/60 shadow-[0_0_4px_2px_rgba(233,183,103,0.4)]"></span>
                    Veiled Lumin
                </a>

                <p class="text-xs text-lavender-grey/50 italic">Where hidden feelings become words.</p>

                {{-- Nav --}}
                <nav class="flex items-center gap-1 text-xs text-lavender-grey/50" aria-label="Footer navigation">
                    <a href="{{ route('home') }}" class="px-2 hover:text-lavender-grey transition duration-150">Home</a>
                    <span class="opacity-30">·</span>
                    <a href="{{ route('poems.index') }}" class="px-2 hover:text-lavender-grey transition duration-150">Poems</a>
                    <span class="opacity-30">·</span>
                    <a href="{{ route('genres.index') }}" class="px-2 hover:text-lavender-grey transition duration-150">Genres</a>
                    <span class="opacity-30">·</span>
                    <a href="{{ route('about') }}" class="px-2 hover:text-lavender-grey transition duration-150">About</a>
                </nav>

                <p class="text-xs text-lavender-grey/30 mt-2">&copy; {{ date('Y') }} Veiled Lumin</p>
            </div>
        </div>
    </footer>

</body>
</html>
