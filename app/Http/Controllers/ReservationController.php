<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Auth;

class ReservationController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth');
	}

	public function rsvp(Request $request) {
		$revp = Reservation::create([
			'id_events'	=> $request->input('id_events'),
			'id_user'	=> Auth::user()->id
		]);
		return redirect()->back()->with('status', 'Thank you for register to this event. Admin will contact you letter!');
	}
}
