@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-lavender-grey mb-1']) }}>
    {{ $value ?? $slot }}
</label>
