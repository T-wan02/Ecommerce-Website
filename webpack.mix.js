const mix = require('laravel-mix');

mix.js('resources/js/test', 'public/js').react();
mix.js('resources/js/home', 'public/js').react();
mix.js('resources/js/productDetail', 'public/js').react();
mix.js('resources/js/profile', 'public/js').react();