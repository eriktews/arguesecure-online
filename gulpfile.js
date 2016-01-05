var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.less('app.less');
	mix.styles('site.min.css');
    mix.scripts([
    	'arsec.js',
    ],'public/js/arsec.js');
    mix.browserSync({
    	proxy: 'argue.app'
    });
});
