{{-- Shared form fields for create & edit poem --}}

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1">Title</label>
    <input type="text" name="title" value="{{ old('title', $poem->title ?? '') }}"
           class="w-full border border-stone-300 rounded-md px-3 py-2 text-sm
                  focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">
    @error('title')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1">
        Slug
        <span class="text-stone-400 font-normal">(leave blank to auto-generate)</span>
    </label>
    <input type="text" name="slug" value="{{ old('slug', $poem->slug ?? '') }}"
           class="w-full border border-stone-300 rounded-md px-3 py-2 text-sm
                  focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">
    @error('slug')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1">Genre</label>
    <select name="genre_id"
            class="w-full border border-stone-300 rounded-md px-3 py-2 text-sm
                   focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">
        <option value="">— None —</option>
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}"
                    @selected(old('genre_id', $poem->genre_id ?? '') == $genre->id)>
                {{ $genre->name }}
            </option>
        @endforeach
    </select>
    @error('genre_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1">
        Excerpt
        <span class="text-stone-400 font-normal">(optional — shown in listings)</span>
    </label>
    <textarea name="excerpt" rows="2"
              class="w-full border border-stone-300 rounded-md px-3 py-2 text-sm
                     focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">{{ old('excerpt', $poem->excerpt ?? '') }}</textarea>
    @error('excerpt')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- ── Cover image ──────────────────────────────────────────────────────── --}}
<div>
    <label class="block text-sm font-medium text-stone-700 mb-1">
        Cover Image
        <span class="text-stone-400 font-normal">(JPG, PNG or WebP &mdash; max 3 MB)</span>
    </label>

    {{-- Current image preview --}}
    @if(!empty($poem->cover_image))
        <div class="mb-3" x-data="{ remove: false }">
            <div x-show="!remove" class="relative inline-block">
                <img src="{{ $poem->cover_url }}"
                     alt="Current cover"
                     class="h-36 w-auto rounded-md object-cover border border-stone-200 shadow-sm">
                <button type="button"
                        @click="remove = true; $refs.removeCover.value = '1'"
                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white
                               rounded-full text-xs flex items-center justify-center shadow transition"
                        title="Remove cover">
                    &times;
                </button>
            </div>
            <p x-show="remove" class="text-sm text-red-500 font-medium">
                Cover will be removed on save.
                <button type="button" @click="remove = false; $refs.removeCover.value = ''"
                        class="underline ml-1 text-stone-500">Undo</button>
            </p>
            <input type="hidden" name="remove_cover" value="" x-ref="removeCover">
        </div>
    @endif

    <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
           class="block w-full text-sm text-stone-600
                  file:mr-3 file:py-1.5 file:px-3
                  file:rounded file:border-0
                  file:text-xs file:font-medium
                  file:bg-stone-100 file:text-stone-700
                  hover:file:bg-stone-200 transition"
           onchange="previewCover(this)">

    {{-- New image preview (before save) --}}
    <img id="cover-preview"
         src="" alt="Preview"
         class="mt-3 h-36 w-auto rounded-md object-cover border border-stone-200 shadow-sm hidden">

    @error('cover_image')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1">Poem</label>
    <textarea name="body" rows="14"
              class="w-full border border-stone-300 rounded-md px-3 py-2 text-sm font-serif leading-relaxed
                     focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">{{ old('body', $poem->body ?? '') }}</textarea>
    @error('body')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-3">
    <input type="hidden" name="featured" value="0">
    <input type="checkbox" name="featured" id="featured" value="1"
           @checked(old('featured', $poem->featured ?? false))
           class="w-4 h-4 rounded border-stone-300 accent-amber-500 cursor-pointer">
    <label for="featured" class="text-sm font-medium text-stone-700 cursor-pointer select-none">
        Feature this poem on the homepage
    </label>
    @error('featured')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1">Status</label>
    <select name="status"
            class="w-full border border-stone-300 rounded-md px-3 py-2 text-sm
                   focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">
        <option value="draft"      @selected(old('status', $poem->status ?? 'draft') === 'draft')>Draft</option>
        <option value="published"  @selected(old('status', $poem->status ?? 'draft') === 'published')>Published</option>
    </select>
    @error('status')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

@once
@push('scripts')
<script>
function previewCover(input) {
    const preview = document.getElementById('cover-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.classList.add('hidden');
    }
}
</script>
@endpush
@endonce
