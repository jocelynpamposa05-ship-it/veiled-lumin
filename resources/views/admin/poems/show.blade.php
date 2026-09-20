@extends('layouts.admin')
@section('page-title', $poem->title)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between gap-4 mb-8">
        <a href="{{ route('admin.poems.index') }}" class="text-sm text-stone-500 hover:text-stone-800 transition">
            &larr; All poems
        </a>
        <a href="{{ route('admin.poems.edit', $poem) }}" class="btn-admin-primary">Edit {{ $poem->status === 'draft' ? 'draft' : 'poem' }}</a>
    </div>

    <article class="bg-white border border-stone-200 rounded-xl shadow-sm overflow-hidden">
        @if($poem->cover_url)
            <img src="{{ $poem->cover_url }}" alt="Cover image for {{ $poem->title }}" class="w-full max-h-96 object-cover">
        @endif
        <div class="p-6 sm:p-10">
            <div class="flex flex-wrap items-center gap-2 text-xs mb-4">
                <span class="uppercase tracking-widest text-stone-400">{{ $poem->genre?->name ?? 'No genre' }}</span>
                <span class="text-stone-300">&middot;</span>
                <span class="font-medium {{ $poem->status === 'published' ? 'text-emerald-600' : 'text-amber-600' }}">
                    {{ ucfirst($poem->status) }}
                </span>
                @if($poem->featured)<span class="text-amber-600">&middot; Featured</span>@endif
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl text-stone-800 leading-tight">{{ $poem->title }}</h1>
            @if($poem->excerpt)
                <p class="mt-4 text-stone-500 italic leading-relaxed">{{ $poem->excerpt }}</p>
            @endif
            <div class="mt-8 pt-8 border-t border-stone-100 font-serif text-lg sm:text-xl leading-loose text-stone-700 whitespace-pre-line">{{ $poem->body }}</div>
        </div>
    </article>
</div>
@endsection
