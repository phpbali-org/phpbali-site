<?php

namespace App\Http\Controllers;

use App\Models\Event;

class ActivitiesController extends Controller
{
    public function index()
    {
        $previous_events = Event::where('published', 1)
            ->where('end_datetime', '<', \Carbon\Carbon::parse(new \DateTime('Asia/Makassar')))
            ->orderBy('end_datetime', 'desc')
            ->get();

        return view('activities', compact('previous_events'));
    }
}
