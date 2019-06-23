<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Socialite;

class ReservationController extends Controller
{
    /**
     * Do reservation by using Github Oauth.
     */
    public function doReservation()
    {
        // Get current event
        $event = Event::with('reservations')
        ->where('published', 1)
        ->orderBy('created_at', 'desc')
        ->first();

        return Socialite::driver('github')
            ->with([
                'redirect_uri' => url("/login/github/callback{$event->path()}"),
            ])
            ->redirect();
    }
}
