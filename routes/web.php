<?php

Route::get('/', 'HomeController@index');

// Reservation
Route::post('register', 'ReservationController@rsvp');

// Activities
Route::get('activities', 'ActivitiesController@index');

// About
Route::get('about', 'AboutController@index');
