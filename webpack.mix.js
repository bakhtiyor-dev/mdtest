const mix = require('laravel-mix');
//
// require('laravel-mix-polyfill');
//
// const TargetsPlugin = require('targets-webpack-plugin')
//
// mix.webpackConfig({
//     plugins: [
//         new TargetsPlugin({
//             browsers: ['last 2 versions', 'chrome >= 41', 'IE 9', 'IE 11', 'IE 10'],
//         }),
//     ]
// });

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/app.scss', 'public/css')
    .vue();
    // .polyfill({
    //     enabled: true,
    //     useBuiltIns: "usage"
    // });

mix.js(["resources/js/admin/admin.js"], "public/js")
    .sass("resources/sass/admin/admin.scss", "public/css")
    .vue();
    // .polyfill({
    //     enabled: true,
    //     useBuiltIns: "usage",
    // });

if (mix.inProduction())
    mix.version();

