<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin — Veiled Lumin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;1,9..144,300;1,9..144,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/build/assets/app-C20ZLflv.css">
    <script type="module" src="/build/assets/app-_swCgE72.js"></script>
</head>

{{--
    Layout
    ──────
    .admin-layout         flex row, 100vw × 100vh, overflow:hidden
      .admin-sidebar      270px wide, in-flow on desktop / fixed off-canvas on mobile
      .admin-body         flex:1, flex column
        .admin-header     52px, flex-shrink:0
        .admin-content    flex:1, overflow-y:auto, scrollable region
--}}
<body class="font-sans text-stone-800 antialiased"
      x-data="{ open: false }"
      @keydown.escape.window="open = false">

{{-- ── Mobile backdrop (sits between sidebar z:40 and content) ─────────── --}}
<div x-show="open"
     x-transition:enter="transition-opacity duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="open = false"
     class="fixed inset-0 z-30 bg-black/50 lg:hidden"
     style="display:none;"></div>

{{-- ════════════ ROOT ════════════ --}}
<div class="admin-layout">

    {{-- ════════ SIDEBAR ════════
         CSS class handles all positioning:
         - mobile:  position:fixed, translateX(-100%) closed / translateX(0) open
         - desktop: position:relative (in-flow), transform:none
    ══════════════════════════ --}}
    <aside class="admin-sidebar"
           :class="{ 'sidebar-open': open }">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5 flex-shrink-0"
             style="border-bottom:1px solid rgba(255,255,255,0.07);">
            <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center"
                 style="background:linear-gradient(135deg,#e9b767 0%,#c9913a 100%);">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13
                             C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253
                             m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253
                             v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="font-serif text-sm font-medium text-white tracking-wide leading-tight">Veiled Lumin</p>
                <p class="text-[9px] uppercase tracking-[0.15em] font-sans mt-0.5"
                   style="color:rgba(180,185,210,0.55);">Editorial Admin</p>
            </div>
        </div>

        {{-- Nav --}}
        <div class="flex-1 overflow-y-auto py-4 px-3">
            <p class="px-3 pb-2 text-[9px] uppercase tracking-[0.15em] font-semibold"
               style="color:rgba(180,185,210,0.4);">Content</p>

            @php
                $poemCount  = \App\Models\Poem::count();
                $genreCount = \App\Models\Genre::count();

                $navItems = [
                    [
                        'href'   => route('admin.dashboard'),
                        'active' => request()->routeIs('admin.dashboard'),
                        'label'  => 'Dashboard',
                        'count'  => null,
                        'icon'   => '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
                    ],
                    [
                        'href'   => route('admin.poems.index'),
                        'active' => request()->routeIs('admin.poems.*'),
                        'label'  => 'Poems',
                        'count'  => $poemCount,
                        'icon'   => '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>',
                    ],
                    [
                        'href'   => route('admin.genres.index'),
                        'active' => request()->routeIs('admin.genres.*'),
                        'label'  => 'Genres',
                        'count'  => $genreCount,
                        'icon'   => '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>',
                    ],
                ];
            @endphp

            <nav class="space-y-0.5">
                @foreach($navItems as $item)
                    <a href="{{ $item['href'] }}"
                       @click="open = false"
                       class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition-colors duration-150"
                       style="{{ $item['active']
                           ? 'background:rgba(233,183,103,0.15); color:#e9b767; font-weight:500;'
                           : 'color:rgba(180,185,210,0.75);' }}"
                       @mouseenter="if(!{{ $item['active'] ? 'true' : 'false' }}) $el.style.background='rgba(255,255,255,0.06)'"
                       @mouseleave="if(!{{ $item['active'] ? 'true' : 'false' }}) $el.style.background='transparent'">
                        {!! $item['icon'] !!}
                        <span class="flex-1 truncate">{{ $item['label'] }}</span>
                        @if($item['count'] !== null)
                            <span class="text-[10px] px-1.5 py-0.5 rounded-full flex-shrink-0"
                                  style="{{ $item['active']
                                      ? 'background:rgba(233,183,103,0.2); color:#e9b767;'
                                      : 'background:rgba(255,255,255,0.08); color:rgba(180,185,210,0.55);' }}">
                                {{ $item['count'] }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Bottom links --}}
        <div class="flex-shrink-0 px-3 py-3 space-y-0.5"
             style="border-top:1px solid rgba(255,255,255,0.07);">
            <a href="{{ route('home') }}"
               @click="open = false"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition-colors duration-150"
               style="color:rgba(180,185,210,0.6);"
               @mouseenter="$el.style.background='rgba(255,255,255,0.06)'"
               @mouseleave="$el.style.background='transparent'">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>View site</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition-colors duration-150"
                        style="color:rgba(180,185,210,0.6);"
                        @mouseenter="$el.style.background='rgba(255,255,255,0.06)'"
                        @mouseleave="$el.style.background='transparent'">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Log out</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ════════ BODY ════════
         flex:1 — fills all horizontal space not used by the sidebar
    ══════════════════════ --}}
    <div class="admin-body">

        {{-- Header --}}
        <header class="admin-header">

            {{-- Hamburger: visible only on mobile --}}
            <button @click="open = !open"
                    class="lg:hidden flex items-center justify-center w-8 h-8 rounded-md
                           text-stone-400 hover:text-stone-600 hover:bg-stone-100
                           transition duration-150 flex-shrink-0"
                    :aria-label="open ? 'Close menu' : 'Open menu'">
                <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-1.5 text-sm flex-1 min-w-0">
                <span class="text-stone-400">Admin</span>
                <span class="text-stone-300">/</span>
                <span class="text-stone-700 font-medium truncate">@yield('page-title', 'Dashboard')</span>
            </div>

            {{-- Search --}}
            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs flex-shrink-0"
                 style="background:#f5f2ec; border:1px solid #e8e2d8; min-width:180px;">
                <svg class="w-3.5 h-3.5 text-stone-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="text-stone-400">Search poems...</span>
            </div>

            {{-- Avatar --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold text-white"
                     style="background:#1c2033;">
                    {{ mb_strtoupper(mb_substr(Auth::user()?->name ?? 'A', 0, 1)) }}
                </div>
                <span class="hidden md:block text-sm font-medium text-stone-700">
                    {{ Auth::user()?->name }}
                </span>
            </div>
        </header>

        {{-- Page content --}}
        <main class="admin-content">
            @if(session('status'))
                <div class="mb-5 rounded-lg bg-green-50 text-green-700 text-sm px-4 py-3 border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div>{{-- /.admin-body --}}

</div>{{-- /.admin-layout --}}

@stack('scripts')
</body>
</html>
