@extends('layouts.public')
@section('title', 'Genres — Veiled Lumin')

@section('content')

<h1 class="font-serif text-3xl text-parchment mb-8">Genres</h1>

@if($genres->isEmpty())
    <p class="text-lavender-grey/60">No genres yet.</p>
@else
    <div class="grid gap-4 sm:grid-cols-2">
        @foreach($genres as $genre)
            <a href="{{ route('genres.show', $genre) }}" class="poem-card group">
                <h2 class="font-serif text-lg text-parchment mb-1 group-hover:text-amber-glow transition duration-200">
                    {{ $genre->name }}
                </h2>
                <span class="text-xs text-lavender-grey/60">
                    {{ $genre->poems_count }} {{ Str::plural('poem', $genre->poems_count) }}
                </span>
            </a>
        @endforeach
    </div>
@endif

@endsection
