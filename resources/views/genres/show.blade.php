@extends('layouts.public')
@section('title', $genre->name . ' — Veiled Lumin')

@section('content')

<a href="{{ route('genres.index') }}" class="back-link">&larr; All genres</a>

<div class="mt-6 mb-2">
    <h1 class="poem-glow font-serif text-3xl text-parchment">{{ $genre->name }}</h1>
</div>

@if($genre->description)
    <p class="text-lavender-grey mt-2 mb-8 text-base">{{ $genre->description }}</p>
@else
    <div class="mb-8"></div>
@endif

@if($poems->isEmpty())
    <p class="text-lavender-grey/60">No poems in this genre yet.</p>
@else
    <div class="grid gap-4 sm:grid-cols-2">
        @foreach($poems as $poem)
            <a href="{{ route('poems.show', $poem) }}" class="poem-card group flex flex-col overflow-hidden">

                {{-- Cover thumbnail --}}
                @if($poem->cover_url)
                    <div class="w-full h-40 overflow-hidden rounded-md mb-4">
                        <img src="{{ $poem->cover_url }}"
                             alt="Cover for {{ $poem->title }}"
                             class="w-full h-full object-cover group-hover:scale-[1.03] transition duration-300">
                    </div>
                @endif

                <h2 class="poem-card-title">{{ $poem->title }}</h2>
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
