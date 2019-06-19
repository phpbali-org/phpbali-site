<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\Event;

class ReservationController extends Controller
{
    public function doReservation($provider)
    {
        // Get current event
        $event = Event::with('reservations')
        ->where('published', 1)
        ->orderBy('created_at', 'desc')
        ->first();

        return Socialite::driver($provider)
            ->redirectUrl(env('GITHUB_CALLBACK_URL')."?event_slug={$event->slug}")
            ->redirect();
    }
}
