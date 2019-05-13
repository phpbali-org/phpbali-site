<?php

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

// Reservation
Route::get('/rsvp/{slug}', 'ReservationController@rsvp')->name('home.rsvp')->middleware('web');

// meetups
Route::get('meetups', 'HomeController@meetups')->name('home.meetups');

// Code of Conduct
Route::get('about', 'HomeController@codeofconduct')->name('home.about');
