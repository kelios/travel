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

mix.webpackConfig({
    output:{
        chunkFilename:'js/vuejs_code_split/[name].js',
    }
});

mix.js('resources/js/app.js', 'public/js')
    .vue();

mix.js('resources/js/travelform.js', 'public/js')
    .vue();
    //.extract(['vue']);

mix.js(["resources/js/admin/admin.js"], "public/js")
    .vue()
    .sass("resources/sass/admin/admin.scss", "public/css");


if (mix.inProduction()) {
    mix.version();
}
