const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .copy('node_modules/@fortawesome/fontawesome-pro/js/regular.min.js', 'public/js/')
    .copy('node_modules/@fortawesome/fontawesome-pro/js/brands.min.js', 'public/js/')
    .copy('node_modules/@fortawesome/fontawesome-pro/js/fontawesome.min.js', 'public/js/')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js/')
    .sass('resources/sass/app.scss', 'public/css')
        .options({
            processCssUrls: false
        });
