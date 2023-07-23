const mix = require('laravel-mix');
require('laravel-vue-lang/mix');
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

mix.sass('node_modules/bootstrap/scss/bootstrap.scss', "public/css");


mix.webpackConfig({
    output:{
        chunkFilename:'js/vuejs_code_split/[name].js',
    }
});

mix.js('resources/js/app.js', 'public/js')
    .vue();

mix
    //.js(["resources/js/admin/admin.js"],"public/js")
    .vue()
    //.sass("resources/sass/admin/admin.scss", "public/css");

mix.styles(
    [
        'public/css/bootstrap.css',
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

mix.lang();

if (mix.inProduction()) {
    mix.version();
}
