process.env.DISABLE_NOTIFIER = true;

const elixir = require('laravel-elixir');
const clean = require('gulp-clean');

require('laravel-elixir-livereload');
require('elixir-typescript');

//require('mitk-elixir-typescript-compiler');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    var assetsFolder = '';
    var vendorFolder = 'public';

    mix
        .sass('main.scss', 'public/css/app.css')
        .typescript([
            './typings/index.d.ts',
            '**/*.ts'
        ], 'public/js')
        .livereload();

    mix.copy('./resources/assets/typescript/**/*.html', vendorFolder + '/partials/');

     mix
         .copy('./node_modules/systemjs-plugin-text/text.js', vendorFolder + '/vendor/text.js');
    //     .copy('./node_modules/material-design-icons/iconfont/', vendorFolder + '/font/')
    //     .copy('./node_modules/systemjs', vendorFolder + '/vendor/systemjs')
    //     .copy('./node_modules/vue-typescript/lib/**/*.js', vendorFolder + '/vendor/vue-typescript')
    //     .copy('./node_modules/clone/clone.js', vendorFolder + '/vendor/clone.js')
    //     .copy('./node_modules/vue/dist/vue.js', vendorFolder + '/vendor/vue.js')
    //     .copy('./node_modules/systemjs/dist/system.js', vendorFolder + '/vendor/system.js')
    //     .copy(vendorFolder + '/vendor/vue-typescript/index.js', vendorFolder + '/vendor/vue-typescript/vue-typescript.js');

        //.webpack('app.js');
        //.webpack('app.ts', 'dist/', 'resources/assets/typescript/app.ts');
        //.copy('mode_modules/zone.js/dist', './public/zone.js/dist');
    //    .copy('node_modules/core-js', vendorFolder + '/core-js')
    //    .copy('node_modules/reflect-metadata', vendorFolder + '/reflect-metadata')
    //    .copy('node_modules/zone.js', vendorFolder + '/zone.js');
    //    .copy('node_modules/@angular', vendorFolder + '/@angular')
    //    .copy('node_modules/es6-promise', vendorFolder + '/es6-promise')
    //    .copy('node_modules/rxjs', vendorFolder + '/rxjs')
});
