@extends('layouts.public')
@section('title', 'Poems — Veiled Lumin')

@section('content')

<h1 class="font-serif text-3xl text-parchment mb-8">Poems</h1>

{{-- ── Genre filter pills ──────────────────────────────────────────────── --}}
<div class="mb-8 flex flex-wrap gap-2">
    <a href="{{ route('poems.index') }}"
       class="{{ !request('genre') ? 'genre-pill-active' : 'genre-pill' }}">
        All
    </a>
    @foreach($genres as $genre)
        <a href="{{ route('poems.index', ['genre' => $genre->slug]) }}"
           class="{{ request('genre') === $genre->slug ? 'genre-pill-active' : 'genre-pill' }}">
            {{ $genre->name }}
        </a>
    @endforeach
</div>

{{-- ── Poem grid ───────────────────────────────────────────────────────── --}}
@if($poems->isEmpty())
    <p class="text-lavender-grey/60">No poems found.</p>
@else
    <div class="grid gap-4 sm:grid-cols-2">
        @foreach($poems as $poem)
            <a href="{{ route('poems.show', $poem) }}" class="poem-card group flex flex-col overflow-hidden">

                {{-- Cover thumbnail --}}
                @if($poem->cover_url)
                    <div class="w-full h-40 overflow-hidden rounded-md mb-4 -mx-0">
                        <img src="{{ $poem->cover_url }}"
                             alt="Cover for {{ $poem->title }}"
                             class="w-full h-full object-cover group-hover:scale-[1.03] transition duration-300">
                    </div>
                @endif

                <h2 class="poem-card-title">{{ $poem->title }}</h2>
                @if($poem->genre)
                    <span class="poem-card-genre">{{ $poem->genre->name }}</span>
                @endif
                @if($poem->excerpt)
                    <p class="poem-card-excerpt">{{ $poem->excerpt }}</p>
                @endif
            </a>
        @endforeach
    </div>

    <div class="mt-10 dark-pagination">
        {{ $poems->links() }}
    </div>
@endif

@endsection
