import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'
import path from 'path'
import glob from 'fast-glob'
import { fileURLToPath } from 'url'

const input = Object.fromEntries(
    glob.sync('resources/js/**/*.js').map((file) => [
        path.relative(
            'resources/js',
            file.slice(0, file.length - path.extname(file).length)
        ),
        fileURLToPath(new URL(file, import.meta.url)),
    ])
)

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/filament/admin/theme.css',
                'resources/js/app.js',
                ...Object.values(input) // ← tambahan dari glob
            ],
            refresh: [
                ...refreshPaths,
                'app/Filament/**',
                'app/Forms/Components/**',
                'app/Livewire/**',
                'app/Infolists/Components/**',
                'app/Providers/Filament/**',
                'app/Tables/Columns/**',
            ],
        }),
    ],
})
