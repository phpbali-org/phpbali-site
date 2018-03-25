<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Auth;
use App\Events;

class ReservationController extends Controller
{
 //    public function __construct()
	// {
	//     $this->middleware('auth');
	// }

	public function rsvp(Request $request, $slug) {
		// check if user registered
		if (Auth::guest()) {
			return redirect()->route('login');
		}else {
			// select data event
			$id_events = Events::where('slug', $slug)->first();
			// count
			$rsvpChecker = Reservation::where('id_events', $id_events->id)->where('id_user', Auth::id())->count();
			if ($rsvpChecker < 1) {
				$rsvp = $this->createReservation($id_events->id, Auth::user()->id);
				if($rsvp){
					return redirect()->back()->with(['status'=>'Thank you for register to this event. Admin will contact you later!','header'=>'Good Job']);
				}else{
					return redirect()->back()->with(['status'=>'Something were wrong! please contact an Administrator','header'=>'Good Job']);
				}
			}else {
				return redirect('/')->with(['status'=>'You have been register to this event!','header'=>'Something wrong!']);
			}
			
		}
	}

	protected function createReservation($id_event, $id_user) {
		$rsvp = Reservation::create([
			'id_events'	=> $id_event,
			'id_user'	=> $id_user
		]);
		return $rsvp;
	}
}
