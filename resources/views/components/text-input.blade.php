@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-white/5 border border-white/15 text-parchment placeholder-lavender-grey/50 rounded-md px-3 py-2 text-sm focus:border-amber-glow focus:ring-1 focus:ring-amber-glow/50 focus:outline-none transition duration-150 disabled:opacity-50']) }}>
