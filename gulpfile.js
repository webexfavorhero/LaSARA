var elixir = require('laravel-elixir');

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

elixir(function(mix) {

    // Copy images straight to public
    mix.copy('resources/assets/images/**', 'public/assets/images');

    // Merge Style CSSs
    mix.styles([
        'resources/assets/css/**'
    ], 'public/assets/css/site.css');

    // Merge Scripts
    mix.scripts([
        'resources/assets/js/**'
    ], 'public/assets/js/site.js');

    mix.sass('app.scss');
    mix.coffee('module.coffee');
});
