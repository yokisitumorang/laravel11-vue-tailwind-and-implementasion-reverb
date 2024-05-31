import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({

    // i add this when i want to deploy to server that use TLS https like ALB or etc
    // server: {
    //     https: true
    // },
    plugins: [
        laravel({
            // input: ['resources/css/app.css'],
            // input: ['resources/css/app.css','resources/js/app.js'],
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            'ziggy': '/vendor/tightenco/ziggy/src/js',
            'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue'
        },
    },
});