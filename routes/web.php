<?php
Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

//Email Verification
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

// Oauth Github
Route::get('auth/github', 'Auth\OauthGithubController@redirectToProvider')->name('oauth.github.provider');
Route::get('auth/github/callback', 'Auth\OauthGithubController@handleProviderCallback')->name('oauth.github.callback');

// Profile
Route::get('/profile','ProfileController@index');
Route::get('/update','ProfileController@edit');
Route::post('/update','ProfileController@update');
Route::post('/updateavatar','ProfileController@updateavatar');
Route::get('/member/{slug}','ProfileController@member');
Route::get('/member','ProfileController@allmember');

// Reservation
Route::post('/rsvp/{slug}','ReservationController@rsvp');

// meetups
Route::get('meetups','HomeController@meetups');

// Code of Conduct
ROute::get('about', 'HomeController@codeofconduct')->name('home.about');


Route::prefix('adminpage')->group(function() {
	// Route Member Dashboard
	Route::get('/members', 'MemberController@index')->name('admin.members');
	Route::get('/members/add', 'MemberController@create')->name('admin.members.create');
	Route::post('/members/add', 'MemberController@store')->name('admin.members.store');
	Route::get('/members/{member}/edit/', 'MemberController@edit')->name('admin.members.edit');
	Route::post('/members/{member}/edit', 'MemberController@update')->name('admin.members.update');
	Route::get('/members/{member}/delete', 'MemberController@destroy')->name('admin.members.delete');

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
