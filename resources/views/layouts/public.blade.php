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

    <link rel="stylesheet" href="/build/assets/app-C20ZLflv.css">
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

            {{-- Mobile nav — self-contained Alpine dropdown --}}
            <div class="sm:hidden relative" x-data="{ open: false }" @keydown.escape.window="open = false">

                {{-- Hamburger button --}}
                <button @click="open = !open"
                        :aria-expanded="open"
                        aria-label="Toggle navigation menu"
                        class="flex items-center justify-center w-9 h-9 rounded-lg
                               border transition duration-150
                               text-lavender-grey
                               hover:text-parchment hover:border-white/20
                               active:scale-95"
                        style="border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.04);">
                    {{-- Hamburger → X toggle --}}
                    <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- Dropdown menu — anchored to the right of the button --}}
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                     @click.outside="open = false"
                     class="absolute right-0 mt-2 w-44 rounded-xl overflow-hidden z-50"
                     style="
                        background: rgba(20,22,31,0.97);
                        border: 1px solid rgba(255,255,255,0.1);
                        box-shadow: 0 16px 40px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
                        top: calc(100% + 8px);
                     ">

                    {{-- Menu items --}}
                    @php
                        $mobileItems = [
                            ['Home',   route('home'),          'home'],
                            ['Poems',  route('poems.index'),   'poems.*'],
                            ['Genres', route('genres.index'),  'genres.*'],
                            ['About',  route('about'),         'about'],
                        ];
                    @endphp

                    <nav class="py-1.5" aria-label="Mobile navigation">
                        @foreach($mobileItems as [$label, $href, $pattern])
                            @php $active = request()->routeIs($pattern); @endphp
                            <a href="{{ $href }}"
                               @click="open = false"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition duration-150
                                      {{ $active
                                          ? 'text-amber-glow bg-white/[0.06]'
                                          : 'text-lavender-grey hover:text-parchment hover:bg-white/[0.05]' }}">
                                {{-- Active indicator dot --}}
                                <span class="w-1 h-1 rounded-full flex-shrink-0 {{ $active ? 'bg-amber-glow' : 'bg-transparent' }}"></span>
                                {{ $label }}
                            </a>
                        @endforeach
                    </nav>

                    {{-- Decorative footer inside dropdown --}}
                    <div class="px-4 py-2.5 border-t" style="border-color: rgba(255,255,255,0.07);">
                        <p class="text-[10px] font-serif italic" style="color: rgba(154,159,179,0.4);">
                            Veiled Lumin
                        </p>
                    </div>
                </div>
            </div>
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
