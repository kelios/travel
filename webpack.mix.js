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
mix.styles(
    [
        'public/css/metravel.css',
    ],
    'public/css/metravel.min.css'
);

mix.styles(
    [
        'public/css/showmetravel.css',
    ],
    'public/css/showmetravel.min.css'
);

//mix.js('resources/js/app.js', 'public/js')
//    .extract(['vue']);
mix.js(['resources/js/admin/admin.js'], 'public/js')
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .extract(['vue'])

if (mix.inProduction()) {
    mix.version();
}
