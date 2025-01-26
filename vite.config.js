import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import compression from 'vite-plugin-compression';
import { visualizer } from 'rollup-plugin-visualizer';
import purgecss from 'vite-plugin-purgecss';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            publicDir: 'public',
        }),
        compression(),
        visualizer(),
        purgecss({
            content: [
                './resources/**/*.blade.php',
                './resources/**/*.js',
                './resources/**/*.css',
            ]
        })
    ],
    resolve: {
        alias: {
            '$': 'jquery',
            'jquery': 'jquery',
            'sweetalert2': 'sweetalert2/dist/sweetalert2.all.js'
        }
    }
});
