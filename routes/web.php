<?php

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

//Email Verification
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

// Oauth Github
Route::get('auth/github', 'Auth\OauthGithubController@redirectToProvider')->name('oauth.github.provider');
Route::get('auth/github/callback', 'Auth\OauthGithubController@handleProviderCallback')->name('oauth.github.callback');

// Profile
Route::get('/myprofile', 'ProfileController@index')->name('myprofile.index')->middleware('web');
Route::get('/myprofile/update/', 'ProfileController@edit')->name('myprofile.update')->middleware('web');
Route::post('/myprofile/update/', 'ProfileController@update')->name('myprofile.update.submit')->middleware('web');
Route::get('/profile/{slug}', 'ProfileController@member')->name('member.index');
Route::get('/members', 'ProfileController@allmember')->name('member.list');

// Reservation
Route::get('/rsvp/{slug}', 'ReservationController@rsvp')->name('home.rsvp')->middleware('web');

// meetups
Route::get('meetups', 'HomeController@meetups')->name('home.meetups');

// Code of Conduct
Route::get('about', 'HomeController@codeofconduct')->name('home.about');
