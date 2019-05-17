<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $event = Event::with('reservations')
        ->where('published', 1)
        ->orderBy('created_at', 'desc')
        ->first();

        $topics = $event->topics()->get();

        $reservation_count = $event->reservations()->count();

        $attended_count = $event->reservations()->whereNotNull('attended_at')->count();

        return view('welcome',
            compact('event', 'topics', 'reservation_count', 'attended_count'));
    }
}
