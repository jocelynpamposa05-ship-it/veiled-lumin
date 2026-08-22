<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Poem;

class HomeController extends Controller
{
    public function index()
    {
        // The single featured poem (most recently featured, published)
        $featuredPoem = Poem::published()
            ->where('featured', true)
            ->latest('published_at')
            ->first();

        // Up to 6 recent published poems, excluding the featured one
        $recentPoems = Poem::published()
            ->with('genre')
            ->when($featuredPoem, fn ($q) => $q->where('id', '!=', $featuredPoem->id))
            ->latest('published_at')
            ->take(6)
            ->get();

        // All genres that have at least one published poem
        $genres = Genre::withCount(['poems' => fn ($q) => $q->published()])
            ->orderBy('name')
            ->get()
            ->filter(fn ($g) => $g->poems_count > 0)
            ->values();

        return view('home', compact('featuredPoem', 'recentPoems', 'genres'));
    }
}
