var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss');
	mix.styles('site.min.css');
    mix.scripts([
    	'arsec.js'
    ],'public/js/arsec.js');
    mix.browserSync({
    	files: [
                'public/css/*.css',                     // This is the one required to get the CSS to inject
                'resources/views/**/*.blade.php',       // Watch the views for changes & force a reload
                'app/**/*.php'                      // Watch the app files for changes & force a reload
            ],
    	proxy: 'argue.app'
    });
});
