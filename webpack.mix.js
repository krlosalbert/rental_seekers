const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .js('resources/js/supervisors/supervisors.js', 'public/js/supervisors')
   .babel('resources/js/functions/functions.js', 'public/js/functions')
   .setPublicPath('public');