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
Route::post('/myprofile/update/avatar', 'ProfileController@updateavatar')->name('myprofile.update.avatar.submit')->middleware('web');
Route::get('/profile/{slug}', 'ProfileController@member')->name('member.index');
Route::get('/members', 'ProfileController@allmember')->name('member.list');

// Reservation
Route::get('/rsvp/{slug}', 'ReservationController@rsvp')->name('home.rsvp')->middleware('web');

// meetups
Route::get('meetups', 'HomeController@meetups')->name('home.meetups');

// Code of Conduct
Route::get('about', 'HomeController@codeofconduct')->name('home.about');

Route::prefix('adminpage')->group(function () {
    // Route Member Dashboard
    Route::get('/members/{member}/edit/', 'MemberController@edit')->name('admin.members.edit');
    Route::post('/members/{member}/edit', 'MemberController@update')->name('admin.members.update');
    Route::get('/members/{member}/delete', 'MemberController@destroy')->name('admin.members.delete');
    Route::get('/members/add', 'MemberController@create')->name('admin.members.create');
    Route::post('/members/add', 'MemberController@store')->name('admin.members.store');
    Route::get('/members/ajaxMembers', 'MemberController@jsonIndex')->name('admin.members.ajax');
    Route::get('/members', 'MemberController@index')->name('admin.members');

    // Route Topic Dashboard
    Route::get('/topics/delete/{slug}', 'TopicController@destroy')->name('admin.topic.delete');
    Route::post('/topics/edit/{slug}', 'TopicController@update')->name('admin.topic.update');
    Route::get('/topics/edit/{slug}', 'TopicController@edit')->name('admin.topic.edit');
    Route::post('/topics/add', 'TopicController@store')->name('admin.topic.store');
    Route::get('/topics/add', 'TopicController@create')->name('admin.topic.create');
    Route::get('/topics/ajaxTopics', 'TopicController@jsonIndex')->name('admin.topic.ajax');
    Route::get('/topics', 'TopicController@index')->name('admin.topic');

    // Route Events Dashboard
    Route::get('/events/delete/{slug}', 'EventController@destroy')->name('admin.event.delete');
    Route::post('/events/edit/{slug}', 'EventController@update')->name('admin.event.update');
    Route::get('/events/edit/{slug}', 'EventController@edit')->name('admin.event.edit');
    Route::post('/events/add', 'EventController@store')->name('admin.event.store');
    Route::get('/events/add', 'EventController@create')->name('admin.event.create');
    Route::get('/events/ajaxEvents', 'EventController@jsonIndex')->name('admin.event.ajax');
    Route::get('/events', 'EventController@index')->name('admin.event');

    // Route Code of Conduct Dashboard
    Route::get('/about', 'CodeOfConductController@index')->name('admin.about');
    Route::post('/about', 'CodeOfConductController@saveChanges')->name('admin.about.store');

    Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/profile/', 'AdminController@show')->name('admin.profile');
    Route::get('/profile/edit', 'AdminController@edit')->name('admin.profile.edit');
    Route::put('/profile/edit', 'AdminController@update')->name('admin.profile.update');
    Route::get('/', 'AdminController@index')->name('admin.home');
});

Route::get('/lorem', 'TestController@foo');
Route::get('/test', 'TestController@index');
