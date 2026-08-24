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

    <style>
        /* Sidebar background — deep navy matching screenshot */
        .admin-sidebar { background: #1c2033; }
        /* Content area — warm parchment background */
        .admin-content { background: #f0ebe0; }
        /* Top bar breadcrumb separator */
        .breadcrumb-sep { color: #c9c4b8; }
    </style>
</head>
<body class="font-sans text-stone-800 antialiased"
      x-data="{ sidebarOpen: false, sidebarCollapsed: false }"
      @keydown.escape.window="sidebarOpen = false">

{{-- ── Mobile backdrop ──────────────────────────────────────────────────── --}}
<div x-show="sidebarOpen"
     x-transition:enter="transition-opacity duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 z-30 bg-black/50 lg:hidden"
     style="display:none;"></div>

<div class="flex h-screen overflow-hidden">

    {{-- ════════════════════════════════════════════════════════════════════
         SIDEBAR
         - Desktop (lg+): always visible, fixed width
         - Mobile: off-canvas drawer
    ════════════════════════════════════════════════════════════════════ --}}
    <aside class="admin-sidebar fixed inset-y-0 left-0 z-40 flex flex-col
                  transition-all duration-200 ease-in-out
                  lg:relative lg:translate-x-0 lg:flex-shrink-0"
           :class="{
               'translate-x-0': sidebarOpen,
               '-translate-x-full lg:translate-x-0': !sidebarOpen,
               'w-52': !sidebarCollapsed,
               'w-16': sidebarCollapsed
           }">

        {{-- ── Logo / wordmark ───────────────────────────────────────────── --}}
        <div class="flex items-center gap-3 px-4 py-5 flex-shrink-0"
             :class="sidebarCollapsed ? 'justify-center px-2' : ''">

            {{-- Icon mark --}}
            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                 style="background: linear-gradient(135deg, #e9b767 0%, #c9913a 100%);">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                </svg>
            </div>

            <div x-show="!sidebarCollapsed" class="min-w-0">
                <div class="font-serif text-sm font-medium text-white leading-tight tracking-wide">Veiled Lumin</div>
                <div class="text-[9px] uppercase tracking-[0.15em] font-sans mt-0.5"
                     style="color: rgba(180,185,210,0.6);">Editorial Admin</div>
            </div>
        </div>

        {{-- ── Nav ───────────────────────────────────────────────────────── --}}
        <div class="flex-1 overflow-y-auto px-2 pb-4">

            {{-- Section label --}}
            <div x-show="!sidebarCollapsed"
                 class="px-3 pt-4 pb-2 text-[9px] uppercase tracking-[0.15em] font-semibold font-sans"
                 style="color: rgba(180,185,210,0.45);">Content</div>

            @php
                $poems_count  = \App\Models\Poem::count();
                $genres_count = \App\Models\Genre::count();

                $navItem = fn(
                    string $indexRoute,
                    string $matchPrefix,
                    string $icon,
                    string $label,
                    ?int $count = null
                ) => [
                    'href'    => route($indexRoute),
                    'active'  => request()->routeIs($matchPrefix . '*'),
                    'icon'    => $icon,
                    'label'   => $label,
                    'count'   => $count,
                ];

                $iconDash   = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>';
                $iconPoems  = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';
                $iconGenres = '<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>';

                $items = [
                    $navItem('admin.dashboard',   'admin.dashboard', $iconDash,   'Dashboard'),
                    $navItem('admin.poems.index',  'admin.poems.',    $iconPoems,  'Poems',  $poems_count),
                    $navItem('admin.genres.index', 'admin.genres.',   $iconGenres, 'Genres', $genres_count),
                ];
            @endphp

            <nav class="space-y-0.5">
                @foreach($items as $item)
                    <a href="{{ $item['href'] }}"
                       @click="sidebarOpen = false"
                       class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition duration-150
                              {{ $item['active']
                                  ? 'font-medium'
                                  : 'hover:bg-white/6' }}"
                       style="{{ $item['active']
                                  ? 'background:rgba(233,183,103,0.15); color:#e9b767;'
                                  : 'color:rgba(180,185,210,0.75);' }}"
                       :class="sidebarCollapsed ? 'justify-center px-2' : ''">

                        {!! $item['icon'] !!}

                        <span x-show="!sidebarCollapsed" class="flex-1 truncate">{{ $item['label'] }}</span>

                        @if($item['count'] !== null)
                            <span x-show="!sidebarCollapsed"
                                  class="text-[10px] font-medium px-1.5 py-0.5 rounded-full flex-shrink-0"
                                  style="{{ $item['active']
                                              ? 'background:rgba(233,183,103,0.2); color:#e9b767;'
                                              : 'background:rgba(255,255,255,0.08); color:rgba(180,185,210,0.6);' }}">
                                {{ $item['count'] }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- ── Footer ─────────────────────────────────────────────────────── --}}
        <div class="px-2 py-3 flex-shrink-0" style="border-top: 1px solid rgba(255,255,255,0.06);">
            <a href="{{ route('home') }}"
               @click="sidebarOpen = false"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition duration-150 hover:bg-white/6"
               style="color:rgba(180,185,210,0.6);"
               :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span x-show="!sidebarCollapsed">View site</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition duration-150 hover:bg-white/6"
                        style="color:rgba(180,185,210,0.6);"
                        :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span x-show="!sidebarCollapsed">Log out</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ════════════════════════════════════════════════════════════════════
         MAIN AREA
    ════════════════════════════════════════════════════════════════════ --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- ── Top bar ─────────────────────────────────────────────────── --}}
        <header class="bg-white border-b border-stone-200 flex-shrink-0"
                style="height: 52px;">
            <div class="h-full px-4 sm:px-6 flex items-center gap-3">

                {{-- Hamburger — mobile drawer + desktop collapse toggle --}}
                <button @click="sidebarOpen = !sidebarOpen; if(window.innerWidth >= 1024) { sidebarCollapsed = !sidebarCollapsed; sidebarOpen = false; }"
                        class="flex items-center justify-center w-8 h-8 rounded-md text-stone-400
                               hover:text-stone-600 hover:bg-stone-100 transition duration-150 flex-shrink-0"
                        :aria-label="sidebarOpen ? 'Close menu' : 'Open menu'">
                    <svg x-show="!sidebarOpen || window.innerWidth >= 1024"
                         class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="sidebarOpen && window.innerWidth < 1024"
                         class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- Breadcrumb --}}
                <div class="flex items-center gap-1.5 text-sm flex-1 min-w-0">
                    <span class="text-stone-400 font-medium">Admin</span>
                    <span class="breadcrumb-sep text-stone-300">/</span>
                    <span class="text-stone-700 font-medium truncate">@yield('page-title', 'Dashboard')</span>
                </div>

                {{-- Right: search + avatar --}}
                <div class="flex items-center gap-3 flex-shrink-0">

                    {{-- Search --}}
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm"
                         style="background:#f5f2ec; border: 1px solid #e8e2d8; min-width: 180px;">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" style="color:#a09880;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span style="color:#b0a898;" class="text-xs">Search poems...</span>
                    </div>

                    {{-- User avatar --}}
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold text-white flex-shrink-0"
                             style="background: #1c2033;">
                            {{ mb_strtoupper(mb_substr(Auth::user()?->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="hidden md:block text-sm font-medium text-stone-700">{{ Auth::user()?->name }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- ── Page content ────────────────────────────────────────────── --}}
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8" style="background:#f0ebe0;">
            @if(session('status'))
                <div class="mb-5 rounded-lg bg-green-50 text-green-700 text-sm px-4 py-3 border border-green-200">
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
