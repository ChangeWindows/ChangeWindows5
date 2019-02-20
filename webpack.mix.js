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
   .copy('node_modules/@fortawesome/fontawesome-pro/webfonts/fa-light-300.*', 'public/webfonts/')
   .copy('node_modules/@fortawesome/fontawesome-pro/webfonts/fa-brands-400.*', 'public/webfonts/')
   .copy('node_modules/simplemde/dist/simplemde.min.js', 'public/js')
   .copy('node_modules/simplemde/dist/simplemde.min.css', 'public/css')
   .sass('resources/sass/app.scss', 'public/css')
      .options({
         processCssUrls: false
      });
