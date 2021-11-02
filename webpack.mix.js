const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-vue3');

mix.vue3('resources/js/app.js', 'public/js')
   .vue3('resources/js/sidebar.js', 'public/js')
   .vue3('resources/js/modal.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/sidebar.scss', 'public/css')
   .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    });
