@extends('layouts.admin')
@section('page-title', 'Poems')

@section('content')

<div class="flex items-center justify-between mb-5">
    <div>
        <a href="{{ route('admin.poems.create') }}" class="btn-admin-primary">+ New Poem</a>
        @if($search)
            <p class="mt-3 text-sm text-stone-500">
                Results for <span class="font-medium text-stone-700">“{{ $search }}”</span>
                <a href="{{ route('admin.poems.index') }}" class="ml-2 text-amber-600 hover:underline">Clear</a>
            </p>
        @endif
    </div>
</div>

<div class="bg-white border border-stone-200 rounded-lg shadow-sm divide-y divide-stone-100">
    @forelse($poems as $poem)
        <div class="px-4 sm:px-5 py-4 flex items-start justify-between gap-3">

            {{-- Title + meta --}}
            <div class="min-w-0 flex-1">
                <div class="font-serif text-stone-800 leading-snug truncate">{{ $poem->title }}</div>
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1">
                    <span class="text-xs text-stone-400">{{ $poem->genre?->name ?? 'No genre' }}</span>
                    <span class="text-stone-300 text-xs">&middot;</span>
                    @if($poem->status === 'published')
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-500">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Draft
                        </span>
                    @endif
                    @if($poem->featured)
                        <span class="text-xs text-amber-600">★ Featured</span>
                    @endif
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-1.5 flex-shrink-0">
                <a href="{{ route('admin.poems.show', $poem) }}"
                   class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs rounded-md
                          border border-stone-200 text-stone-600
                          hover:border-stone-300 hover:bg-stone-50 transition duration-150">
                    <span class="hidden sm:inline">View</span>
                    <span class="sm:hidden">Read</span>
                </a>
                <a href="{{ route('admin.poems.edit', $poem) }}"
                   class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs rounded-md
                          border border-stone-200 text-stone-600
                          hover:border-stone-300 hover:bg-stone-50 transition duration-150">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span class="hidden sm:inline">Edit</span>
                </a>
                <button type="button"
                        x-data=""
                        x-on:click="$dispatch('open-modal', 'delete-poem-{{ $poem->id }}')"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs rounded-md
                               border border-red-100 text-red-400
                               hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span class="hidden sm:inline">Delete</span>
                </button>
            </div>

        </div>

        <x-modal name="delete-poem-{{ $poem->id }}" maxWidth="md" focusable>
            <form method="POST" action="{{ route('admin.poems.destroy', $poem) }}" class="p-6">
                @csrf
                @method('DELETE')
                <h2 class="font-serif text-xl text-stone-800">Delete “{{ $poem->title }}”?</h2>
                <p class="mt-2 text-sm text-stone-500 leading-relaxed">
                    This permanently removes the {{ $poem->status === 'draft' ? 'draft' : 'poem' }} and its cover image. This cannot be undone.
                </p>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close-modal', 'delete-poem-{{ $poem->id }}')"
                            class="px-4 py-2 text-sm rounded-md border border-stone-200 text-stone-600 hover:bg-stone-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm rounded-md bg-red-600 text-white hover:bg-red-700 transition">
                        Delete permanently
                    </button>
                </div>
            </form>
        </x-modal>
    @empty
        <div class="px-5 py-12 text-center text-stone-400 text-sm">
            <p class="font-serif italic mb-2">{{ $search ? 'No poems match your search.' : 'No poems yet.' }}</p>
            <a href="{{ route('admin.poems.create') }}" class="text-amber-600 hover:underline text-xs">Add your first poem →</a>
        </div>
    @endforelse
</div>

<div class="mt-6">{{ $poems->links() }}</div>

@endsection
