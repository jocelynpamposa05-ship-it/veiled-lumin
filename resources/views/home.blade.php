@extends('layouts.public')
@section('title', 'Veiled Lumin — Where hidden feelings become words')
@section('main-class', 'flex-1 w-full')

@section('content')

{{-- ════════════════════════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden">

    {{-- Atmospheric glow behind hero --}}
    <div aria-hidden="true" class="pointer-events-none select-none absolute inset-0 flex items-center justify-center">
        {{-- Main central glow --}}
        <div style="
            width: 600px; height: 400px;
            background: radial-gradient(ellipse at center,
                rgba(233,183,103,0.09) 0%,
                rgba(140,122,166,0.05) 40%,
                transparent 70%);
            filter: blur(40px);
        "></div>
    </div>

    {{-- Subtle grain overlay --}}
    <div aria-hidden="true" style="
        position: absolute; inset: 0;
        background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.75%22 numOctaves=%224%22 stitchTiles=%22stitch%22/><feColorMatrix type=%22saturate%22 values=%220%22/></filter><rect width=%22200%22 height=%22200%22 filter=%22url(%23n)%22 opacity=%220.03%22/></svg>');
        pointer-events: none;
    "></div>

    <div class="relative max-w-5xl mx-auto px-6 pt-20 pb-20 text-center">

        {{-- Eyebrow --}}
        <p class="section-eyebrow fade-in">A quiet poetry archive</p>

        {{-- Title --}}
        <h1 class="fade-in fade-in-delay-1 poem-glow font-serif text-glow-amber
                   text-5xl sm:text-6xl lg:text-7xl text-parchment leading-[1.1] mb-5">
            Veiled Lumin
        </h1>

        {{-- Tagline --}}
        <p class="fade-in fade-in-delay-2 font-serif italic text-xl text-lavender-grey mb-3">
            Where hidden feelings become words.
        </p>

        {{-- Supporting sentence --}}
        <p class="fade-in fade-in-delay-3 text-sm text-lavender-grey/60 max-w-md mx-auto leading-relaxed mb-10">
            A quiet collection of thoughts, memories, emotions, and stories written between the lines.
        </p>

        {{-- CTAs --}}
        <div class="fade-in fade-in-delay-4 flex items-center justify-center flex-wrap gap-3">
            <a href="{{ route('poems.index') }}" class="btn-primary">
                Explore the Poems
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('genres.index') }}" class="btn-ghost">Discover the Genres</a>
        </div>

    </div>

    {{-- Bottom fade into page --}}
    <div aria-hidden="true" style="
        position: absolute; bottom: 0; left: 0; right: 0; height: 80px;
        background: linear-gradient(to bottom, transparent, #14161F);
        pointer-events: none;
    "></div>
</section>

<div class="max-w-5xl mx-auto px-6">

{{-- ════════════════════════════════════════════════════════════════════════
     FEATURED POEM
════════════════════════════════════════════════════════════════════════ --}}
@if(isset($featuredPoem) && $featuredPoem)
<section class="mt-4 mb-16 fade-in">

    <div class="featured-poem-block">
        <div class="flex flex-col md:flex-row">

            {{-- Cover image column (if present) --}}
            @if($featuredPoem->cover_url)
                <div class="md:w-64 lg:w-80 flex-shrink-0">
                    <img src="{{ $featuredPoem->cover_url }}"
                         alt="Cover for {{ $featuredPoem->title }}"
                         class="w-full h-56 md:h-full object-cover">
                </div>
            @endif

            {{-- Text column --}}
            <div class="flex-1 p-8 md:p-10 flex flex-col justify-center">

                {{-- Label --}}
                <p class="section-eyebrow mb-4">Featured Poem</p>

                {{-- Title --}}
                <h2 class="font-serif text-3xl sm:text-4xl text-parchment text-glow-amber leading-tight mb-3">
                    {{ $featuredPoem->title }}
                </h2>

                {{-- Genre --}}
                @if($featuredPoem->genre)
                    <span class="text-xs uppercase tracking-widest text-dusty-violet mb-4 block">
                        {{ $featuredPoem->genre->name }}
                    </span>
                @endif

                {{-- Excerpt --}}
                @if($featuredPoem->excerpt)
                    <p class="font-serif italic text-lavender-grey text-base leading-relaxed mb-6 max-w-prose line-clamp-3">
                        "{{ $featuredPoem->excerpt }}"
                    </p>
                @elseif($featuredPoem->body)
                    <p class="font-serif italic text-lavender-grey text-base leading-relaxed mb-6 max-w-prose line-clamp-3">
                        "{{ Str::limit($featuredPoem->body, 160) }}"
                    </p>
                @endif

                {{-- Read link --}}
                <a href="{{ route('poems.show', $featuredPoem) }}"
                   class="inline-flex items-center gap-2 text-sm text-amber-glow hover:text-amber-glow/80 transition duration-150 group">
                    Read the poem
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition duration-150"
                         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>

            </div>
        </div>
    </div>
</section>
@endif


{{-- ════════════════════════════════════════════════════════════════════════
     RECENT POEMS
════════════════════════════════════════════════════════════════════════ --}}
<section class="mb-16">

    {{-- Section header --}}
    <div class="flex items-end justify-between mb-8">
        <div>
            <p class="section-eyebrow">From the collection</p>
            <h2 class="section-heading">Recent Poems</h2>
            <p class="text-sm text-lavender-grey/60 mt-1">Words recently left on the page.</p>
        </div>
        <a href="{{ route('poems.index') }}"
           class="hidden sm:inline-flex items-center gap-1.5 text-xs text-lavender-grey/60
                  hover:text-lavender-grey transition duration-150 shrink-0 mb-1">
            All poems
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

    @if($recentPoems->isNotEmpty())

        {{-- First poem: full-width editorial highlight --}}
        @php $first = $recentPoems->first(); $rest = $recentPoems->skip(1); @endphp

        <a href="{{ route('poems.show', $first) }}"
           class="group block rounded-xl border border-white/8 bg-white/[0.025]
                  hover:border-white/15 hover:bg-white/[0.04] transition duration-200 mb-4 overflow-hidden">
            <div class="flex gap-0">

                {{-- Cover image (fixed width, never stretches the row) --}}
                @if($first->cover_url)
                    <div class="w-28 sm:w-40 flex-shrink-0">
                        <img src="{{ $first->cover_url }}"
                             alt="Cover for {{ $first->title }}"
                             class="w-full h-full object-cover group-hover:scale-[1.02] transition duration-300"
                             style="aspect-ratio: unset;">
                    </div>
                @else
                    {{-- Elegant default: dark panel with decorative initial --}}
                    <div class="w-28 sm:w-40 flex-shrink-0 flex items-center justify-center"
                         style="background: linear-gradient(135deg, rgba(233,183,103,0.06) 0%, rgba(140,122,166,0.06) 100%);">
                        <span class="font-serif text-5xl text-amber-glow/20 select-none leading-none">
                            {{ mb_substr($first->title, 0, 1) }}
                        </span>
                    </div>
                @endif

                <div class="flex-1 px-6 py-5 min-w-0">
                    <div class="text-[10px] uppercase tracking-widest text-amber-glow/60 mb-2">Featured Entry</div>
                    <h3 class="font-serif text-xl text-parchment leading-snug mb-1
                               group-hover:text-amber-glow transition duration-150">
                        {{ $first->title }}
                    </h3>
                    @if($first->genre)
                        <span class="text-xs uppercase tracking-widest text-dusty-violet">{{ $first->genre->name }}</span>
                    @endif
                    @if($first->excerpt)
                        <p class="text-sm text-lavender-grey/70 mt-2 leading-relaxed line-clamp-2">{{ $first->excerpt }}</p>
                    @endif
                    <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-glow/70
                                group-hover:text-amber-glow transition duration-150">
                        Read poem
                        <svg class="w-3 h-3 group-hover:translate-x-0.5 transition duration-150"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </div>
        </a>

        {{-- Remaining poems: compact editorial list --}}
        @if($rest->isNotEmpty())
            <div class="divide-y divide-white/[0.06] rounded-xl border border-white/8 overflow-hidden">
                @foreach($rest as $poem)
                    <a href="{{ route('poems.show', $poem) }}"
                       class="poem-entry items-center px-5 py-4 bg-white/[0.02]
                              hover:bg-white/[0.04] transition duration-150">

                        {{-- Thumbnail or decorative initial --}}
                        <div class="poem-entry-image bg-white/[0.03]">
                            @if($poem->cover_url)
                                <img src="{{ $poem->cover_url }}"
                                     alt=""
                                     class="w-full h-full object-cover group-hover:scale-[1.04] transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center"
                                     style="background: linear-gradient(135deg, rgba(233,183,103,0.07) 0%, rgba(140,122,166,0.07) 100%);">
                                    <span class="font-serif text-2xl text-amber-glow/25 select-none leading-none">
                                        {{ mb_substr($poem->title, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Text --}}
                        <div class="poem-entry-body">
                            <div class="poem-entry-title">{{ $poem->title }}</div>
                            <div class="poem-entry-meta">
                                @if($poem->genre)
                                    <span class="text-dusty-violet/80">{{ $poem->genre->name }}</span>
                                    <span class="mx-1 opacity-40">·</span>
                                @endif
                                @if($poem->published_at)
                                    <span>{{ $poem->published_at->format('M j, Y') }}</span>
                                @endif
                            </div>
                            @if($poem->excerpt)
                                <p class="poem-entry-excerpt">{{ $poem->excerpt }}</p>
                            @endif
                        </div>

                        {{-- Arrow --}}
                        <svg class="w-3.5 h-3.5 text-lavender-grey/30 group-hover:text-amber-glow/60
                                    flex-shrink-0 transition duration-150"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>

                    </a>
                @endforeach
            </div>
        @endif

        {{-- Mobile "all poems" link --}}
        <div class="mt-6 text-center sm:hidden">
            <a href="{{ route('poems.index') }}" class="btn-ghost text-xs">View all poems</a>
        </div>

    @else
        <div class="text-center py-16 rounded-xl border border-white/6">
            <p class="font-serif italic text-lavender-grey/50">No poems published yet.</p>
            <p class="text-xs text-lavender-grey/30 mt-2">Check back soon.</p>
        </div>
    @endif

</section>


{{-- ════════════════════════════════════════════════════════════════════════
     GENRES
════════════════════════════════════════════════════════════════════════ --}}
@if(isset($genres) && $genres->isNotEmpty())
<section class="mb-16">

    {{-- Ornamental divider --}}
    <div class="divider-ornament mb-10 text-xs text-lavender-grey/30">✦</div>

    <div class="text-center mb-8">
        <p class="section-eyebrow">Browse the collection</p>
        <h2 class="section-heading mb-2">Explore by Feeling</h2>
        <p class="text-sm text-lavender-grey/60">Every emotion has its own language.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-2.5">
        @foreach($genres as $genre)
            <a href="{{ route('genres.show', $genre) }}" class="genre-chip">
                {{ $genre->name }}
                <span class="text-lavender-grey/30 text-xs">{{ $genre->poems_count }}</span>
            </a>
        @endforeach
    </div>

</section>
@endif


{{-- ════════════════════════════════════════════════════════════════════════
     ABOUT PREVIEW
════════════════════════════════════════════════════════════════════════ --}}
<section class="mb-16">

    <div class="divider-ornament mb-10 text-xs text-lavender-grey/30">✦</div>

    <div class="max-w-xl mx-auto text-center">
        <p class="section-eyebrow">The story behind the name</p>
        <h2 class="section-heading mb-5">Between What Is Felt<br class="hidden sm:block"> and What Is Said</h2>

        <p class="text-lavender-grey/70 leading-relaxed mb-3 text-base">
            Veiled Lumin is a quiet space for poems that live between what is felt and what is said.
        </p>
        <p class="text-lavender-grey/50 text-sm leading-relaxed mb-3">
            Some feelings are difficult to explain.
        </p>
        <p class="text-lavender-grey/50 text-sm leading-relaxed mb-8">
            Some are easier to leave between the lines.
        </p>

        <a href="{{ route('about') }}"
           class="inline-flex items-center gap-2 text-sm text-lavender-grey/70
                  hover:text-amber-glow transition duration-150 group">
            Read more about Veiled Lumin
            <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition duration-150"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

</section>

</div>{{-- /max-w-5xl --}}

@endsection
