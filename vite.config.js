import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Force manifest to public/build/manifest.json (no .vite/ subdirectory)
        // so Laravel's default Vite helper finds it without extra config
        manifest: 'manifest.json',
        outDir: 'public/build',
    },
});
