let mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
    // .sass('resources/sass/app.scss', 'public/css')
    .vue()
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js'),
                '~': path.resolve(__dirname, 'resources/js/components')
            },
            extensions: ['.js', '.vue', '.json']
        },
    })
    .version();

