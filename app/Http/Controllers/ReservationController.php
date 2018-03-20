<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Auth;
use App\Events;

class ReservationController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth');
	}

	public function rsvp(Request $request) {
		$id_events = Events::where('slug', $request->slug)->first();

		$rsvp = Reservation::create([
			'id_events'	=> $id_events->id,
			'id_user'	=> Auth::user()->id
		]);
		
		if($rsvp)
		{
			return redirect()->back()->with('status', 'Thank you for register to this event. Admin will contact you later!');
		}else{
			return redirect()->back()->with('status', 'Something were wrong! please contact an Administrator');
		}
	}
}
