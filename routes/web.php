<?php

Route::get('/', 'HomeController@index');

// Reservation
Route::get('register/{provider}', 'ReservationController@doReservation');

// Event
Route::get('events', 'EventController@index');

// About
Route::get('about', 'AboutController@index');

Route::get('login', 'AuthController@showLoginForm');
// Oauth Github
Route::get('login/{provider}', 'AuthController@redirectToProvider');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback');

Route::post('logout', 'AuthController@logout');

Route::middleware(['auth'])->group(function () {
    Route::get('events/create', 'EventController@create');
    Route::post('events/store', 'EventController@store');
    Route::get('events/{event}', 'EventController@show');
    Route::put('events/{event}/publish', 'EventController@publish');
    Route::put('events/{event}/unpublish', 'EventController@unpublish');

    Route::get('events/{event}/topics/create', 'TopicController@create');
    Route::post('events/{event}/topics/store', 'TopicController@store');

    Route::get('events/{event}/attendees/create', 'AttendeeController@create');

    Route::get('users', 'UserController@index');
    Route::get('users/create', 'UserController@create');
    Route::post('users/store', 'UserController@store');
});
