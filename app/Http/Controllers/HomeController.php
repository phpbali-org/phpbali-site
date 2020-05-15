<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Beranda';

        $event = Event::with('reservations')
        ->where('published', 1)
        ->orderBy('created_at', 'desc')
        ->first();

        $topics = !empty($event) ? $event->topics()->get() : null;

        $participants = $event->reservations()->get()->sortByDesc('created_at');

        return view(
            'pages.event',
            compact('title', 'event', 'topics', 'participants')
        );
    }
}
