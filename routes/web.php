<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/{any}', function () {
//     return view('index');
// })->where('any','.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('adminpage')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.home');
});

// dashboard view (admin or user)
Route::get('dashboard', function(){
	return view('dashboard');
});
