@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── Stat cards ──────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
    @foreach([
        ['label' => 'Total Poems',  'value' => $stats['poems']],
        ['label' => 'Published',    'value' => $stats['published']],
        ['label' => 'Drafts',       'value' => $stats['drafts']],
        ['label' => 'Genres',       'value' => $stats['genres']],
    ] as $stat)
    <div class="bg-white rounded-lg p-5 border border-stone-200 shadow-sm">
        <div class="font-serif text-3xl text-stone-800">{{ $stat['value'] }}</div>
        <div class="text-xs text-stone-400 mt-1 uppercase tracking-wide font-sans">{{ $stat['label'] }}</div>
    </div>
    @endforeach
</div>

{{-- ── Quick actions ───────────────────────────────────────────────────── --}}
<div class="mt-8 flex flex-wrap gap-3">
    <a href="{{ route('admin.poems.create') }}" class="btn-admin-primary">+ New Poem</a>
    <a href="{{ route('admin.genres.create') }}" class="btn-admin-secondary">+ New Genre</a>
</div>

@endsection
