<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Reservation;
use Auth;

class ReservationController extends Controller
{
    public function rsvp(Request $request)
    {
        dd($request);
    }
}
