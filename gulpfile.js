var elixir = require('laravel-elixir');

var paths = {
    'jquery': 'vendor/components/jquery',
    'bootstrap': 'vendor/twitter/bootstrap/dist'
};

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

    // Merge Admin CSSs
    mix.styles([
        '../../../' + paths.bootstrap + '/css/bootstrap.css'
    ], 'public/assets/css/admin.css');

    // Merge Admin Scripts
    mix.scripts([
        '../../../' + paths.jquery + '/jquery.js',
        '../../../' + paths.bootstrap + '/js/bootstrap.js'
    ], 'public/assets/js/admin.js');

    mix.sass('app.scss');
    mix.coffee('module.coffee');
});
