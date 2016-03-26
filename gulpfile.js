var elixir = require('laravel-elixir');

var paths = {
    'jquery': 'vendor/components/jquery',
    'bootstrap': 'vendor/twitter/bootstrap'
};

elixir(function(mix) {

    // Copy images straight to public
    mix.copy('resources/assets/images/**', 'public/assets/images');

    // Copy fonts to public
    mix.copy([
        paths.bootstrap + '/fonts/**'
    ], 'public/assets/fonts');

    // Merge Style CSSs
    mix.styles([
        'resources/assets/css/**'
    ], 'public/assets/css/site.css');

    // Merge Scripts
    mix.scripts([
        'resources/assets/js/**'
    ], 'public/assets/js/site.js');

    // Merge Admin CSSs
    mix.styles([
        '../../../' + paths.bootstrap + '/dist/css/bootstrap.css'
    ], 'public/assets/css/admin.css');

    // Merge Admin Scripts
    mix.scripts([
        '../../../' + paths.jquery + '/jquery.js',
        '../../../' + paths.bootstrap + '/dist/js/bootstrap.js'
    ], 'public/assets/js/admin.js');

    mix.sass('app.scss');
    mix.coffee('module.coffee');
    mix.coffee('module_update.coffee');
});
