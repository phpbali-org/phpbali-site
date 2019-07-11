<?php

Route::get('/', 'HomeController@index');

// Reservation
Route::get('register/{provider}', 'ReservationController@doReservation');

// Event
Route::get('events', 'EventController@index');

// About
Route::get('about', 'AboutController@index');

// Oauth Github
Route::get('login/{provider}', 'AuthController@redirectToProvider')->name('login');
Route::get('login/{provider}/callback/{events?}/{event_slug?}', 'AuthController@handleProviderCallback');

Route::post('logout', 'AuthController@logout');

Route::middleware(['auth'])->group(function () {

    // Event and topics
    Route::middleware(['admin'])->group(function () {
        Route::get('events/create', 'EventController@create');
        Route::post('events/store', 'EventController@store');
        Route::get('events/{event}/edit', 'EventController@edit');
        Route::put('events/{event}/update', 'EventController@update');
        Route::put('events/{event}/publish', 'EventController@publish');
        Route::put('events/{event}/unpublish', 'EventController@unpublish');
        Route::delete('events/{event}', 'EventController@destroy');

        Route::get('events/{event}/topics/create', 'TopicController@create');
        Route::post('events/{event}/topics/store', 'TopicController@store');
        Route::get('events/{event}/topics/{topic}/edit', 'TopicController@edit')->name('topic.edit');
        Route::put('events/{event}/topics/{topic}/update', 'TopicController@update')->name('topic.update');
        Route::delete('events/{event}/topics/{topic}', 'TopicController@destroy')->name('topic.destroy');

        Route::get('users', 'UserController@index');
        Route::get('users/create', 'UserController@create');
        Route::post('users/store', 'UserController@store');
        Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('users/{user}/update', 'UserController@update');
        Route::delete('users/{user}', 'UserController@destroy');
    });

    // Register event for authenticated user
    Route::put('events/{event}/register', 'EventController@register');

    // Attendee
    Route::middleware(['admin', 'staff'])->group(function () {
        Route::get('events/{event}/attendees/create', 'AttendeeController@create');
        Route::post('events/{event}/attendees/store', 'AttendeeController@store');
        Route::post('events/{event}/attendees/attendance', 'AttendeeController@attendance');
    });
});

// Fixed bug cannot create and store event. I think because Laravel read route sequentially.
Route::get('events/{event}', 'EventController@show');
