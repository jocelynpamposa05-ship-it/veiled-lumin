@extends('layouts.admin')
@section('page-title', 'Genres')

@section('content')

<div class="flex justify-between items-center mb-5">
    <a href="{{ route('admin.genres.create') }}" class="btn-admin-primary">+ New Genre</a>
</div>

<div class="bg-white border border-stone-200 rounded-lg shadow-sm divide-y divide-stone-100">
    @forelse($genres as $genre)
        <div class="flex items-center justify-between px-5 py-4">
            <div>
                <div class="font-serif text-stone-800">{{ $genre->name }}</div>
                <div class="text-xs text-stone-400 mt-1">
                    {{ $genre->poems_count }} {{ Str::plural('poem', $genre->poems_count) }}
                </div>
            </div>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('admin.genres.edit', $genre) }}"
                   class="text-stone-400 hover:text-stone-700 transition duration-150">Edit</a>
                <form method="POST" action="{{ route('admin.genres.destroy', $genre) }}"
                      onsubmit="return confirm('Delete this genre? Poems in it will become genre-less.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-400 hover:text-red-600 transition duration-150">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="px-5 py-10 text-center text-stone-400 text-sm">No genres yet.</div>
    @endforelse
</div>

@endsection
