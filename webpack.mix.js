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

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');

const path = require("path");
mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '@': path.resolve('resources/js'),
            '@core': path.resolve('resources/js/core'),
            '@admin': path.resolve('resources/js/admins'),
            '@frontend': path.resolve('resources/js/frontends'),
        }
    }
});

mix.styles([
    'public/admins/css/app.css',
    'public/admins/more/css/style.css',
    'public/admins/more/css/style.css',
    'public/sweetalert2/sweetalert2.min.css',
], 'public/admins/css/admin.min.css');

mix.scripts([
    'public/sweetalert2/sweetalert2.min.js',
], 'public/admins/js/admin.min.js');

mix.scripts([
    'public/frontend/models/js/bootstrap.min.js',
    'public/frontend/models/js/popper.min.js',
    'public/frontend/js/main.js'
], 'public/frontend/models/js/admin.min.js');

mix.js('resources/js/frontends/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/admins/app-admin.js', 'public/admins/js')
    .vue()

 