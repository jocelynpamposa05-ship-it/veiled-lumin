@extends('layouts.admin')
@section('page-title', 'Poems')

@section('content')

<div class="flex items-center justify-between mb-5">
    <a href="{{ route('admin.poems.create') }}" class="btn-admin-primary">+ New Poem</a>
</div>

<div class="bg-white border border-stone-200 rounded-lg shadow-sm divide-y divide-stone-100">
    @forelse($poems as $poem)
        <div class="px-4 sm:px-5 py-4">

            {{-- Mobile: stack title/meta above actions --}}
            <div class="flex items-start justify-between gap-3">

                {{-- Left: title + meta --}}
                <div class="min-w-0 flex-1">
                    <div class="font-serif text-stone-800 leading-snug truncate">{{ $poem->title }}</div>
                    <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1">
                        <span class="text-xs text-stone-400">{{ $poem->genre?->name ?? 'No genre' }}</span>
                        <span class="text-stone-300 text-xs">&middot;</span>
                        @if($poem->status === 'published')
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-500">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 inline-block"></span>
                                Draft
                            </span>
                        @endif
                        @if($poem->featured)
                            <span class="text-xs text-amber-600 font-medium">★ Featured</span>
                        @endif
                    </div>
                </div>

                {{-- Right: actions --}}
                <div class="flex items-center gap-1 flex-shrink-0">
                    <a href="{{ route('admin.poems.edit', $poem) }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-md
                              border border-stone-200 text-stone-600 bg-white
                              hover:border-stone-300 hover:bg-stone-50 transition duration-150">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span class="hidden sm:inline">Edit</span>
                    </a>
                    <form method="POST" action="{{ route('admin.poems.destroy', $poem) }}"
                          onsubmit="return confirm('Delete this poem?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-md
                                       border border-red-100 text-red-400 bg-white
                                       hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition duration-150">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span class="hidden sm:inline">Delete</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    @empty
        <div class="px-5 py-12 text-center text-stone-400 text-sm">
            <p class="font-serif italic mb-2">No poems yet.</p>
            <a href="{{ route('admin.poems.create') }}" class="text-amber-600 hover:underline text-xs">Add your first poem →</a>
        </div>
    @endforelse
</div>

<div class="mt-6">{{ $poems->links() }}</div>

@endsection
