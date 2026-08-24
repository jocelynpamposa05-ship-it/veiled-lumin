@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── Page heading + actions ─────────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="font-serif text-2xl text-stone-800">Dashboard</h2>
        <p class="text-sm text-stone-400 mt-1 leading-relaxed max-w-sm">
            An overview of what's been written, published, and left waiting for its final line.
        </p>
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        <a href="{{ route('admin.genres.create') }}"
           class="inline-flex items-center gap-1.5 px-3 py-2 text-sm rounded-lg border border-stone-300
                  text-stone-600 hover:bg-stone-50 hover:border-stone-400 transition duration-150">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            New genre
        </a>
        <a href="{{ route('admin.poems.create') }}"
           class="inline-flex items-center gap-1.5 px-3 py-2 text-sm rounded-lg
                  bg-ink text-parchment hover:bg-ink/90 transition duration-150 font-medium">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            New poem
        </a>
    </div>
</div>

{{-- ── Stat cards ──────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">

    {{-- Total poems — dark card --}}
    <div class="bg-ink rounded-xl p-5 border border-ink col-span-2 sm:col-span-1">
        <div class="w-7 h-7 rounded-md flex items-center justify-center mb-3"
             style="background:rgba(233,183,103,0.15);">
            <svg class="w-4 h-4 text-amber-glow" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div class="font-serif text-4xl text-parchment leading-none">{{ $stats['poems'] }}</div>
        <div class="text-xs mt-1.5 uppercase tracking-widest font-sans"
             style="color:rgba(154,159,179,0.7);">Total Poems</div>
    </div>

    {{-- Published --}}
    <div class="bg-white rounded-xl p-5 border border-stone-200 shadow-sm">
        <div class="w-7 h-7 rounded-md bg-emerald-50 flex items-center justify-center mb-3">
            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="font-serif text-4xl text-stone-800 leading-none">{{ $stats['published'] }}</div>
        <div class="text-xs text-stone-400 mt-1.5 uppercase tracking-widest font-sans">Published</div>
    </div>

    {{-- Drafts --}}
    <div class="bg-white rounded-xl p-5 border border-stone-200 shadow-sm">
        <div class="w-7 h-7 rounded-md bg-amber-50 flex items-center justify-center mb-3">
            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
        </div>
        <div class="font-serif text-4xl text-stone-800 leading-none">{{ $stats['drafts'] }}</div>
        <div class="text-xs text-stone-400 mt-1.5 uppercase tracking-widest font-sans">Drafts</div>
    </div>

    {{-- Genres --}}
    <div class="bg-white rounded-xl p-5 border border-stone-200 shadow-sm">
        <div class="w-7 h-7 rounded-md bg-violet-50 flex items-center justify-center mb-3">
            <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
            </svg>
        </div>
        <div class="font-serif text-4xl text-stone-800 leading-none">{{ $stats['genres'] }}</div>
        <div class="text-xs text-stone-400 mt-1.5 uppercase tracking-widest font-sans">Genres</div>
    </div>

</div>

{{-- ── Two column layout: left (recent + genres) | right (quote + drafts) ─ --}}
<div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-4">

    {{-- ── LEFT COLUMN ────────────────────────────────────────────────── --}}
    <div class="space-y-4">

        {{-- Recent poems --}}
        <div class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-stone-100">
                <h3 class="font-medium text-stone-800 text-sm">Recent poems</h3>
                <a href="{{ route('admin.poems.index') }}"
                   class="text-xs text-amber-600 hover:text-amber-700 transition duration-150">
                    View all →
                </a>
            </div>

            @if($recentPoems->isEmpty())
                <div class="px-5 py-10 text-center">
                    <p class="text-sm text-stone-400 font-serif italic">No poems written yet.</p>
                    <p class="text-xs text-stone-300 mt-1">
                        <a href="{{ route('admin.poems.create') }}" class="text-amber-600 hover:underline">Write your first poem →</a>
                    </p>
                </div>
            @else
                <div class="divide-y divide-stone-50">
                    @foreach($recentPoems as $poem)
                        <a href="{{ route('admin.poems.edit', $poem) }}"
                           class="flex items-center gap-3 px-5 py-3.5 hover:bg-stone-50 transition duration-150">

                            {{-- Initial avatar --}}
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 font-serif text-sm font-medium"
                                 style="background:rgba(233,183,103,0.12); color:rgba(233,183,103,0.9);">
                                {{ mb_strtoupper(mb_substr($poem->title, 0, 1)) }}
                            </div>

                            {{-- Title + date --}}
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-stone-800 truncate">{{ $poem->title }}</div>
                                <div class="text-xs text-stone-400 mt-0.5">
                                    @if($poem->status === 'published')
                                        <span class="text-emerald-600">Published</span>
                                    @else
                                        <span class="text-amber-500">Draft</span>
                                    @endif
                                    @if($poem->published_at ?? $poem->created_at)
                                        &middot; {{ ($poem->published_at ?? $poem->created_at)->diffForHumans() }}
                                    @endif
                                </div>
                            </div>

                            {{-- Status badge --}}
                            @if($poem->status === 'published')
                                <span class="flex-shrink-0 text-[10px] font-semibold uppercase tracking-wider
                                             px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    Published
                                </span>
                            @else
                                <span class="flex-shrink-0 text-[10px] font-semibold uppercase tracking-wider
                                             px-2 py-0.5 rounded-full bg-amber-50 text-amber-500 border border-amber-100">
                                    Draft
                                </span>
                            @endif

                        </a>
                    @endforeach
                </div>

                @if($stats['poems'] > 5)
                    <div class="px-5 py-3 border-t border-stone-50 text-center text-xs text-stone-300 font-serif italic">
                        That's every poem you've written so far — the rest of the page is open and waiting.
                    </div>
                @endif
            @endif
        </div>

        {{-- Genres --}}
        <div class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-stone-100">
                <h3 class="font-medium text-stone-800 text-sm">Genres</h3>
                <a href="{{ route('admin.genres.index') }}"
                   class="text-xs text-amber-600 hover:text-amber-700 transition duration-150">
                    Manage →
                </a>
            </div>

            @if($genres->isEmpty())
                <div class="px-5 py-10 text-center">
                    <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-violet-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-stone-600 mb-1">No genres <span class="text-amber-600">yet</span></p>
                    <p class="text-xs text-stone-400 max-w-xs mx-auto leading-relaxed">
                        Group your poems by form or mood —
                        <a href="{{ route('admin.genres.create') }}" class="text-amber-600 hover:underline">create your first genre</a>.
                    </p>
                </div>
            @else
                <div class="px-5 py-4 flex flex-wrap gap-2">
                    @foreach($genres as $genre)
                        <a href="{{ route('admin.genres.edit', $genre) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs
                                  border border-stone-200 text-stone-600
                                  hover:border-amber-glow/50 hover:text-stone-800 transition duration-150">
                            {{ $genre->name }}
                            <span class="text-stone-300">{{ $genre->poems_count }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    {{-- ── RIGHT COLUMN ────────────────────────────────────────────────── --}}
    <div class="space-y-4">

        {{-- Inspirational quote card --}}
        <div class="bg-ink rounded-xl p-6 border border-white/5">
            <p class="font-serif italic text-parchment/90 text-sm leading-relaxed mb-4">
                "A poem begins as a lump in the throat; a homesickness, a lovesickness."
            </p>
            <p class="text-xs uppercase tracking-widest font-sans"
               style="color:rgba(154,159,179,0.6);">— Robert Frost</p>
        </div>

        {{-- Drafts --}}
        <div class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-stone-100">
                <h3 class="font-medium text-stone-800 text-sm">Drafts</h3>
            </div>

            @if($draftPoems->isEmpty())
                <div class="px-5 py-8 text-center">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-stone-600 mb-1">Nothing unfinished</p>
                    <p class="text-xs text-stone-400 leading-relaxed mb-4 max-w-[200px] mx-auto">
                        Start a new poem and it'll sit here until you're ready to publish it.
                    </p>
                    <a href="{{ route('admin.poems.create') }}"
                       class="inline-flex items-center px-4 py-2 text-xs rounded-lg border border-stone-200
                              text-stone-600 hover:bg-stone-50 hover:border-stone-300 transition duration-150">
                        Start writing
                    </a>
                </div>
            @else
                <div class="divide-y divide-stone-50">
                    @foreach($draftPoems as $poem)
                        <a href="{{ route('admin.poems.edit', $poem) }}"
                           class="flex items-center gap-3 px-5 py-3 hover:bg-stone-50 transition duration-150">
                            <div class="w-7 h-7 rounded-md flex items-center justify-center flex-shrink-0 font-serif text-xs"
                                 style="background:rgba(245,158,11,0.1); color:rgba(245,158,11,0.8);">
                                {{ mb_strtoupper(mb_substr($poem->title, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm text-stone-700 truncate">{{ $poem->title }}</div>
                                <div class="text-xs text-stone-400 mt-0.5">{{ $poem->created_at->diffForHumans() }}</div>
                            </div>
                            <svg class="w-3.5 h-3.5 text-stone-300 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
