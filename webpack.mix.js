let mix = require('laravel-mix');

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
let components = {
    jquery: ['$', 'window.jQuery', 'jQuery'],
    tether: ['Tether', 'window.Tether'],
    'popper.js/dist/umd/popper.js': ['Popper']
};
mix.autoload(components)
    .js('resources/assets/public/js/app.js', 'public/js')
    .sass('resources/assets/public/sass/app.scss', 'public/css');

mix.autoload(components)
    .js('resources/assets/admin/js/admin.js', 'public/js')
    .sass('resources/assets/admin/sass/admin.scss', 'public/css');