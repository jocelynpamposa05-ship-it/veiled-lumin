<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Poem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PoemController extends Controller
{
    public function index()
    {
        $poems = Poem::with('genre')->latest()->paginate(15);

        return view('admin.poems.index', compact('poems'));
    }

    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.poems.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('covers', 'public');
        }

        Poem::create($validated);

        return redirect()->route('admin.poems.index')->with('status', 'Poem created.');
    }

    public function edit(Poem $poem)
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.poems.edit', compact('poem', 'genres'));
    }

    public function update(Request $request, Poem $poem)
    {
        $validated = $this->validated($request, $poem);

        if ($request->hasFile('cover_image')) {
            // Remove the old image before storing the new one
            $poem->deleteCoverImage();
            $validated['cover_image'] = $request->file('cover_image')
                ->store('covers', 'public');
        }

        // Allow the admin to explicitly remove the cover without uploading a new one
        if ($request->boolean('remove_cover')) {
            $poem->deleteCoverImage();
            $validated['cover_image'] = null;
        }

        $poem->update($validated);

        return redirect()->route('admin.poems.index')->with('status', 'Poem updated.');
    }

    public function destroy(Poem $poem)
    {
        $poem->deleteCoverImage();
        $poem->delete();

        return redirect()->route('admin.poems.index')->with('status', 'Poem deleted.');
    }

    private function validated(Request $request, ?Poem $poem = null): array
    {
        return $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', Rule::unique('poems', 'slug')->ignore($poem)],
            'body'         => ['required', 'string'],
            'excerpt'      => ['nullable', 'string', 'max:500'],
            'genre_id'     => ['nullable', 'exists:genres,id'],
            'status'       => ['required', 'in:draft,published'],
            'cover_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'remove_cover' => ['nullable', 'boolean'],
            'featured'     => ['nullable', 'boolean'],
        ]);
    }
}
