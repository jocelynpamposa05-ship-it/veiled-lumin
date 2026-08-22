<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Poem;
use Illuminate\Http\Request;

class PoemController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::orderBy('name')->get();

        $poems = Poem::query()
            ->published()
            ->when($request->filled('genre'), function ($query) use ($request) {
                $query->whereHas('genre', fn ($q) => $q->where('slug', $request->query('genre')));
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('poems.index', compact('poems', 'genres'));
    }

    public function show(Poem $poem)
    {
        abort_unless($poem->status === 'published', 404);

        return view('poems.show', compact('poem'));
    }
}
