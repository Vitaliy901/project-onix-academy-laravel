import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
				'resources/scss/app.scss',
				'resources/js/app.js',
				'resources/js/article-list',
				'resources/js/article-page',
				'resources/js/jquery-3.6.0.min',
				'resources/js/main',
				'resources/js/news-all',
				'resources/js/slick.min',
            ],
            refresh: true,
        }),
    ],
});
