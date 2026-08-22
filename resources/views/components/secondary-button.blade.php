<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-transparent border border-white/20 rounded-md font-semibold text-xs text-lavender-grey uppercase tracking-widest hover:border-white/40 hover:text-parchment focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-ink disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
