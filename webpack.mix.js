let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js/script.js').extract(['lodash','jquery','popper.js','bootstrap','axios'])
   .sass('resources/assets/sass/app.scss', 'public/css/style-app.css');

mix.styles([
	'resources/assets/dashboard-template/css/bootstrap.min.css',
	'resources/assets/dashboard-template/css/sidebar-nav.min.css',
	'resources/assets/dashboard-template/css/animate.css',
	'resources/assets/dashboard-template/css/style.css',
	'resources/assets/dashboard-template/css/blue-dark.css'
	], 'public/css/app-dashboard.css');
mix.scripts([
	'resources/assets/dashboard-template/js/jquery.js',
	'resources/assets/dashboard-template/js/bs.js',
	'resources/assets/dashboard-template/js/jquery.slimscroll.js',
	'resources/assets/dashboard-template/js/sidebar-nav.min.js',
	'resources/assets/dashboard-template/js/waves.js',
	'resources/assets/dashboard-template/js/custom.js'
	], 'public/js/app-dashboard.js');
