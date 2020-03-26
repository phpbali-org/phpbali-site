<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Event as EventResource;
use App\Models\Event;

class EventController extends Controller
{
    // Get latest event
    public function latest()
    {
        return new EventResource(Event::with('reservations')
        ->where('published', 1)
        ->orderBy('created_at', 'desc')
        ->first());
    }
}
