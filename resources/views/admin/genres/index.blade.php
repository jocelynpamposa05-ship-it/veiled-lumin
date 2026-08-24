@extends('layouts.admin')
@section('page-title', 'Genres')

@section('content')

<div class="flex items-center justify-between mb-5">
    <a href="{{ route('admin.genres.create') }}" class="btn-admin-primary">+ New Genre</a>
</div>

<div class="bg-white border border-stone-200 rounded-lg shadow-sm divide-y divide-stone-100">
    @forelse($genres as $genre)
        <div class="px-4 sm:px-5 py-4 flex items-start justify-between gap-3">

            {{-- Name + count --}}
            <div class="min-w-0 flex-1">
                <div class="font-serif text-stone-800 leading-snug">{{ $genre->name }}</div>
                <div class="text-xs text-stone-400 mt-1">
                    {{ $genre->poems_count }} {{ Str::plural('poem', $genre->poems_count) }}
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-1.5 flex-shrink-0">
                <a href="{{ route('admin.genres.edit', $genre) }}"
                   class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs rounded-md
                          border border-stone-200 text-stone-600
                          hover:border-stone-300 hover:bg-stone-50 transition duration-150">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span class="hidden sm:inline">Edit</span>
                </a>
                <form method="POST" action="{{ route('admin.genres.destroy', $genre) }}"
                      onsubmit="return confirm('Delete this genre? Poems in it will become genre-less.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs rounded-md
                                   border border-red-100 text-red-400
                                   hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span class="hidden sm:inline">Delete</span>
                    </button>
                </form>
            </div>

        </div>
    @empty
        <div class="px-5 py-12 text-center text-stone-400 text-sm">
            <p class="font-serif italic mb-2">No genres yet.</p>
            <a href="{{ route('admin.genres.create') }}" class="text-amber-600 hover:underline text-xs">Add your first genre →</a>
        </div>
    @endforelse
</div>

@endsection
