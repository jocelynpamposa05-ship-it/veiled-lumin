{{-- Shared form fields for create & edit genre --}}

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1.5">Name</label>
    <input type="text" name="name" value="{{ old('name', $genre->name ?? '') }}"
           class="w-full border border-stone-300 rounded-md px-3 py-2.5 text-sm bg-white
                  focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">
    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1.5">
        Slug <span class="text-stone-400 font-normal text-xs">(auto-generated if blank)</span>
    </label>
    <input type="text" name="slug" value="{{ old('slug', $genre->slug ?? '') }}"
           class="w-full border border-stone-300 rounded-md px-3 py-2.5 text-sm bg-white
                  focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">
    @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-stone-700 mb-1.5">
        Description <span class="text-stone-400 font-normal text-xs">(optional)</span>
    </label>
    <textarea name="description" rows="3"
              class="w-full border border-stone-300 rounded-md px-3 py-2.5 text-sm resize-none
                     focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 outline-none transition">{{ old('description', $genre->description ?? '') }}</textarea>
    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>
