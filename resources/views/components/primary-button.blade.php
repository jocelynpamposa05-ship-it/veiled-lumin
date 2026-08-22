<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-amber-glow border border-transparent rounded-md font-semibold text-xs text-ink uppercase tracking-widest hover:bg-amber-glow/90 focus:bg-amber-glow/90 active:bg-amber-glow focus:outline-none focus:ring-2 focus:ring-amber-glow/60 focus:ring-offset-2 focus:ring-offset-ink disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
