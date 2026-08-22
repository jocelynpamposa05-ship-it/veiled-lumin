@extends('layouts.public')
@section('title', $poem->title . ' — Veiled Lumin')

@section('content')

<article class="max-w-2xl mx-auto">

    {{-- Back link --}}
    <a href="{{ route('poems.index') }}" class="back-link">&larr; Back to poems</a>

    {{-- Cover image --}}
    @if($poem->cover_url)
        <div class="mt-6 rounded-xl overflow-hidden border border-white/8 shadow-[0_8px_40px_rgba(0,0,0,0.5)]">
            <img src="{{ $poem->cover_url }}"
                 alt="Cover image for {{ $poem->title }}"
                 class="w-full max-h-80 object-cover">
        </div>
    @endif

    {{-- Title with amber glow --}}
    <div class="{{ $poem->cover_url ? 'mt-7' : 'mt-6' }} mb-3">
        <h1 class="poem-glow font-serif text-4xl text-parchment text-glow-amber leading-tight">
            {{ $poem->title }}
        </h1>
    </div>

    {{-- Genre tag --}}
    @if($poem->genre)
        <a href="{{ route('genres.show', $poem->genre) }}" class="genre-pill inline-block mt-1">
            {{ $poem->genre->name }}
        </a>
    @endif

    {{-- Divider --}}
    <div class="mt-8 mb-8 border-t border-white/8"></div>

    {{-- Poem body — the star of the page --}}
    <div class="font-serif text-xl leading-[1.9] text-parchment/90 whitespace-pre-line tracking-wide">
        {{ $poem->body }}
    </div>

    {{-- Published date --}}
    <p class="mt-12 text-xs text-lavender-grey/50">
        Published {{ $poem->published_at?->format('F j, Y') }}
    </p>

</article>

@endsection
