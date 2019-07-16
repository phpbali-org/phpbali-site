<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Models\Event;
use App\Http\Resources\Event as EventResource;

Route::get('/event/last', function () {
    return new EventResource(Event::with('reservations')
    ->where('published', 1)
    ->orderBy('created_at', 'desc')
    ->first());
});
