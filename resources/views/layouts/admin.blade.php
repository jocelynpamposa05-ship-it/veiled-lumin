<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin — Veiled Lumin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;1,9..144,300;1,9..144,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/build/assets/app-CS3g80mm.css">
    <script type="module" src="/build/assets/app-_swCgE72.js"></script>
</head>
<body class="font-sans bg-stone-100 text-stone-800 antialiased"
      x-data="{ sidebarOpen: false }"
      @keydown.escape.window="sidebarOpen = false">

{{-- ── Mobile backdrop overlay ──────────────────────────────────────────── --}}
<div x-show="sidebarOpen"
     x-transition:enter="transition-opacity duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 z-30 bg-black/60 md:hidden"
     style="display:none;">
</div>

<div class="flex min-h-screen">

    {{-- ── Sidebar ───────────────────────────────────────────────────────────
         Desktop: always visible at w-56
         Mobile: off-canvas drawer, slides in from left
    ──────────────────────────────────────────────────────────────────────── --}}
    <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-ink flex flex-col
                  transition-transform duration-200 ease-in-out
                  md:static md:inset-auto md:z-auto md:translate-x-0 md:w-56 md:flex-shrink-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

        {{-- Wordmark --}}
        <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between flex-shrink-0">
            <div>
                <a href="{{ route('home') }}"
                   class="font-serif text-base text-parchment tracking-wide hover:text-amber-glow transition duration-150">
                    Veiled Lumin
                </a>
                <div class="text-[10px] mt-0.5 font-sans uppercase tracking-widest"
                     style="color:rgba(154,159,179,0.5);">Admin</div>
            </div>
            {{-- Close button — mobile only --}}
            <button @click="sidebarOpen = false"
                    class="md:hidden flex items-center justify-center w-7 h-7 rounded-md
                           transition duration-150"
                    style="color:rgba(154,159,179,0.6);"
                    aria-label="Close menu">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-5 space-y-0.5 text-sm overflow-y-auto">
            @php
                $navLink = fn(string $indexRoute, string $matchPrefix, string $icon, string $label) =>
                    '<a href="' . route($indexRoute) . '" @click="sidebarOpen = false" class="flex items-center gap-2.5 px-3 py-2.5 rounded-md transition duration-150 ' .
                    (request()->routeIs($matchPrefix . '*')
                        ? 'bg-amber-glow/15 text-amber-glow font-medium'
                        : 'text-lavender-grey hover:bg-white/6 hover:text-parchment') .
                    '">' . $icon . '<span>' . $label . '</span></a>';

                $iconDash   = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>';
                $iconPoems  = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';
                $iconGenres = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>';
            @endphp

            {!! $navLink('admin.dashboard',   'admin.dashboard', $iconDash,   'Dashboard') !!}
            {!! $navLink('admin.poems.index',  'admin.poems.',    $iconPoems,  'Poems') !!}
            {!! $navLink('admin.genres.index', 'admin.genres.',   $iconGenres, 'Genres') !!}
        </nav>

        {{-- Footer --}}
        <div class="px-3 py-4 border-t border-white/10 space-y-0.5 text-sm flex-shrink-0">
            <a href="{{ route('home') }}"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-md transition duration-150 text-lavender-grey/70 hover:text-parchment hover:bg-white/6">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>View site</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-md transition duration-150 text-lavender-grey/70 hover:text-parchment hover:bg-white/6">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Log out</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main area ──────────────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Top bar --}}
        <header class="sticky top-0 z-20 bg-white border-b border-stone-200
                       px-4 sm:px-6 md:px-8 py-3 flex items-center gap-3">

            {{-- Hamburger / X toggle — mobile only --}}
            <button @click="sidebarOpen = !sidebarOpen"
                    :aria-label="sidebarOpen ? 'Close navigation' : 'Open navigation'"
                    :aria-expanded="sidebarOpen"
                    class="md:hidden flex items-center justify-center w-9 h-9 rounded-lg
                           border border-stone-200 text-stone-500
                           hover:border-stone-300 hover:text-stone-700
                           active:scale-95 transition duration-150 flex-shrink-0">

                {{-- Hamburger — shown when sidebar is closed --}}
                <svg x-show="!sidebarOpen"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 rotate-90"
                     x-transition:enter-end="opacity-100 rotate-0"
                     class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                {{-- X — shown when sidebar is open --}}
                <svg x-show="sidebarOpen"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -rotate-90"
                     x-transition:enter-end="opacity-100 rotate-0"
                     class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

            <h1 class="font-serif text-base sm:text-lg text-stone-800 flex-1 truncate">
                @yield('page-title', 'Dashboard')
            </h1>

            <span class="hidden sm:block text-xs text-stone-400 flex-shrink-0">
                {{ Auth::user()?->name }}
            </span>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-4 sm:p-6 md:p-8 bg-stone-100">
            @if(session('status'))
                <div class="mb-5 rounded-md bg-green-50 text-green-700 text-sm px-4 py-3 border border-green-200">
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
