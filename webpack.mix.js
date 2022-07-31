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

mix
    .sass('resources/scss/app.scss', 'public/css')

    .js('resources/js/app.js', 'public/js')

    // --- EXTRACT VENDORS
    .js('resources/js/vendor/___.js', 'public/js/vendor/___.js')
    .extract(['vue'      ], 'js/vendor/packages/vue.js')
    .extract(['jquery'   ], 'js/vendor/packages/jquery.js')
    .extract(['bootstrap'], 'js/vendor/packages/bootstrap.js')

    // remaining vendors
    .extract()

    // --- OPTIONS
    .vue()
    .disableNotifications()
    .sourceMaps(false)
    .version();


let dir = 'dev';
let ids = 'named';
if(mix.inProduction()) {
    dir = 'prod';
    ids = 'deterministic';
}
mix.webpackConfig({
    output: {
        chunkFilename: (pathData) => {
            return pathData.chunk.name === null ? 'js/' + dir + '/[name].js?[contenthash]' : '[name].js';
        },
    },
    optimization: {
        chunkIds: ids
    }
});

