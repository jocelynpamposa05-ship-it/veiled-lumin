<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('poems')->orderBy('name')->get();

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        Genre::create($validated);

        return redirect()->route('admin.genres.index')->with('status', 'Genre created.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $this->validated($request, $genre);

        $genre->update($validated);

        return redirect()->route('admin.genres.index')->with('status', 'Genre updated.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres.index')->with('status', 'Genre deleted.');
    }

    private function validated(Request $request, ?Genre $genre = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('genres', 'slug')->ignore($genre)],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
