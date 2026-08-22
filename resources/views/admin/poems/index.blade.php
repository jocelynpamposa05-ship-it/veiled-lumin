@extends('layouts.admin')
@section('page-title', 'Poems')

@section('content')

<div class="flex justify-between items-center mb-5">
    <a href="{{ route('admin.poems.create') }}" class="btn-admin-primary">+ New Poem</a>
</div>

<div class="bg-white border border-stone-200 rounded-lg shadow-sm divide-y divide-stone-100">
    @forelse($poems as $poem)
        <div class="flex items-center justify-between px-5 py-4">
            <div>
                <div class="font-serif text-stone-800">{{ $poem->title }}</div>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-xs text-stone-400">{{ $poem->genre?->name ?? 'No genre' }}</span>
                    <span class="text-stone-300">&middot;</span>
                    @if($poem->status === 'published')
                        <span class="text-xs font-medium text-emerald-600">Published</span>
                    @else
                        <span class="text-xs font-medium text-amber-500">Draft</span>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('admin.poems.edit', $poem) }}"
                   class="text-stone-400 hover:text-stone-700 transition duration-150">Edit</a>
                <form method="POST" action="{{ route('admin.poems.destroy', $poem) }}"
                      onsubmit="return confirm('Delete this poem?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-400 hover:text-red-600 transition duration-150">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="px-5 py-10 text-center text-stone-400 text-sm">No poems yet.</div>
    @endforelse
</div>

<div class="mt-6">{{ $poems->links() }}</div>

@endsection
