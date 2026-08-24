<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Vite 5+ outputs the manifest to .vite/manifest.json
        Vite::useManifestFilename('.vite/manifest.json');
    }
}
