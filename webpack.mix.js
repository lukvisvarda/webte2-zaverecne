let mix = require('laravel-mix');
const path = require('path');

mix.js('frontend/app.js', 'public/js')
    // .sass('resources/sass/app.scss', 'public/css')
    .vue()
    .webpackConfig({

        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'frontend'),
                '~': path.resolve(__dirname, 'frontend/components')
            },
            extensions: ['.js', '.vue', '.json']
        },
    })
    .version();

