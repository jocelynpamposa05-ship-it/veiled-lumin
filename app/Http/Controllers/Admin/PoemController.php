<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Poem;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PoemController extends Controller
{
    public function __construct(private CloudinaryService $cloudinary) {}

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
            $uploaded = $this->cloudinary->upload($request->file('cover_image'), 'veiled-lumin/covers');
            // Store the public_id — lets us delete/transform later
            $validated['cover_image']     = $uploaded['public_id'];
            $validated['cover_image_url'] = $uploaded['url'];
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
            // Delete the old Cloudinary image first
            $poem->deleteCoverImage($this->cloudinary);

            $uploaded = $this->cloudinary->upload($request->file('cover_image'), 'veiled-lumin/covers');
            $validated['cover_image']     = $uploaded['public_id'];
            $validated['cover_image_url'] = $uploaded['url'];
        }

        if ($request->boolean('remove_cover')) {
            $poem->deleteCoverImage($this->cloudinary);
            $validated['cover_image']     = null;
            $validated['cover_image_url'] = null;
        }

        $poem->update($validated);

        return redirect()->route('admin.poems.index')->with('status', 'Poem updated.');
    }

    public function destroy(Poem $poem)
    {
        $poem->deleteCoverImage($this->cloudinary);
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
