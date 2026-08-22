<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount(['poems' => fn ($q) => $q->published()])
            ->orderBy('name')
            ->get();

        return view('genres.index', compact('genres'));
    }

    public function show(Genre $genre)
    {
        $poems = $genre->poems()
            ->published()
            ->latest('published_at')
            ->paginate(9);

        return view('genres.show', compact('genre', 'poems'));
    }
}
