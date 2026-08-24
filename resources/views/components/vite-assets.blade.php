@php
    // Read manifest directly — works in all environments without @vite's hot-file detection
    $manifestPath = public_path('build/manifest.json');
    $css = null;
    $js  = null;

    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
        $css = $manifest['resources/css/app.css']['file'] ?? null;
        $js  = $manifest['resources/js/app.js']['file']  ?? null;
    }
@endphp

@if($css)
    <link rel="stylesheet" href="/build/assets/{{ $css }}">
@endif
@if($js)
    <script type="module" src="/build/assets/{{ $js }}"></script>
@endif
