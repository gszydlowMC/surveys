const mix = require('laravel-mix');
const webpack = require('webpack');
const Dotenv = require('dotenv-webpack');

mix.webpackConfig({
    devtool: 'source-map',
    plugins: [
        new Dotenv(),
        new webpack.ProvidePlugin({
            '$': 'jquery',
            'jQuery': 'jquery',
            'window.jQuery': 'jquery',
        }),
    ],
    stats: {
        children: true
    }
});

const layout = '';

mix.js('resources/' + layout + '/assets/js/app.js', 'public/js')
mix.sass('resources/' + layout + '/assets/' + layout + '/sass/app.scss', 'public/css');
mix.copyDirectory('resources/assets/' + layout + '/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/' + layout + '/img', 'public/img');
