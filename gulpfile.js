process.env.DISABLE_NOTIFIER = true;

const elixir = require('laravel-elixir');

require('laravel-elixir-vue');
require('laravel-elixir-livereload');

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

elixir(mix => {
    mix.copy('node_modules/material-design-icons/iconfont/', 'public/font/');

    mix.sass('main.scss', 'public/css/app.css')
       .webpack('app.js')
       .livereload();
});
