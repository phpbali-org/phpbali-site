<?php

Route::get('/', 'HomeController@index');

// Reservation
// Route::get('register/github', 'ReservationController@doReservation');

// Event
Route::get('events', 'EventController@index');
Route::get('events/{event}', 'EventController@show');

// About
Route::get('about', 'AboutController@index');

// Oauth Github
Route::get('login/github', 'AuthController@redirectToProvider')->name('login');
Route::get('login/github/callback', 'AuthController@handleProviderCallback');

Route::post('logout', 'AuthController@logout');

Route::middleware(['auth'])->group(function () {
    Route::get('events/create', 'EventController@create');
    Route::post('events/store', 'EventController@store');
    Route::put('events/{event}/publish', 'EventController@publish');
    Route::put('events/{event}/unpublish', 'EventController@unpublish');
    Route::put('events/{event}/register', 'EventController@register');

    Route::get('events/{event}/topics/create', 'TopicController@create');
    Route::post('events/{event}/topics/store', 'TopicController@store');

    Route::get('events/{event}/attendees/create', 'AttendeeController@create');

    Route::get('users', 'UserController@index');
    Route::get('users/create', 'UserController@create');
    Route::post('users/store', 'UserController@store');
});
