import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',

                'resources/js/src_js/app.js',
                'resources/scss/style.scss',
            ],
            refresh: ['resources/**'],
        }),
        ckeditor5({ theme: require.resolve('@ckeditor/ckeditor5-theme-lark') })
    ],
});

