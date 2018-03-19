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

Route::get('/', 'HomeController@index');

// Route::get('/{any}', function () {
//     return view('index');
// })->where('any','.*');

Auth::routes();
//Email Verification
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

// Profile
Route::get('/profile','ProfileController@index');
Route::get('/update','ProfileController@edit');


Route::prefix('adminpage')->group(function() {
	// Route Member Dashboard
	Route::get('/members', 'MemberController@index')->name('admin.members');

	// Route Topic Dashboard
	Route::get('/topics/delete/{slug}', 'TopicController@destroy')->name('admin.topic.delete');
	Route::post('/topics/edit/{slug}', 'TopicController@update')->name('admin.topic.update');
	Route::get('/topics/edit/{slug}', 'TopicController@edit')->name('admin.topic.edit');
	Route::post('/topics/add', 'TopicController@store')->name('admin.topic.store');
	Route::get('/topics/add', 'TopicController@create')->name('admin.topic.create');
	Route::get('/topics', 'TopicController@index')->name('admin.topic');

	// Route Events Dashboard
	Route::get('/events/delete/{slug}', 'EventController@destroy')->name('admin.event.delete');
	Route::post('/events/edit/{slug}', 'EventController@update')->name('admin.event.update');
	Route::get('/events/edit/{slug}', 'EventController@edit')->name('admin.event.edit');
	Route::post('/events/add', 'EventController@store')->name('admin.event.store');
	Route::get('/events/add', 'EventController@create')->name('admin.event.create');
	Route::get('/events', 'EventController@index')->name("admin.event");
	
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.home');
});