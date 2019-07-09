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

        $topics = $event->topics()->get();

        return view('welcome',
            compact('title', 'event', 'topics'));
    }
}
