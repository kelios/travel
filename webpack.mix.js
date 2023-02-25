const mix = require('laravel-mix');
require('laravel-vue-lang/mix');
require('laravel-mix-purgecss');
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

mix.webpackConfig({
    output:{
        chunkFilename:'js/vuejs_code_split/[name].js',
    }
});

mix.js('resources/js/app.js', 'public/js')
    .js(["resources/js/admin/admin.js"], "public/js")
    .vue({ version: 2 })
    .postCss('public/css/metravel.css',  'public/css/metravel.min.css')
    .postCss('public/css/showmetravel.css', 'public/css/showmetravel.min.css')
    .sass("resources/sass/admin/admin.scss", "public/css")
    .purgeCss({
        enabled: true,
    });


mix.lang();

if (mix.inProduction()) {
    mix.version();
}
