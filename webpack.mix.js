const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/user.js', 'public/js/user.js')
    .js('resources/js/dictionary.js', 'public/js/dictionary.js')
    .js('resources/js/patient.js', 'public/js/patient.js')
    .js('resources/js/search.js', 'public/js/search.js')
    .js('resources/js/pharmacy.js', 'public/js/pharmacy.js')
    .js('resources/js/pos.js', 'public/js/pos.js')
    .css('resources/css/app.css', 'public/css/selectize.css')

    



