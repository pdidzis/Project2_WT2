import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true,
        },
    },
    plugins: [
        laravel({
            input: ['resources/js/index.jsx'], // Main entry point for Laravel Vite
            refresh: true, // Enable auto-refresh for Laravel
        }),
        react(), // Enable React support
    ],
});
