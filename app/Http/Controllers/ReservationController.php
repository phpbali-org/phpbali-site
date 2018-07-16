<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Auth;
use App\Events;

class ReservationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function rsvp($slug) {
		$id_events = Events::where('slug', $slug)->first();
		$rsvpChecker = Reservation::where('id_events', $id_events->id)->where('id_user', Auth::id())->count();
		if ($rsvpChecker < 1) {
			$rsvp = $this->createReservation($id_events->id, Auth::guard('web')->user()->id);
			if($rsvp){
				return redirect()->back()->with([
					'msg'=>'Thank you for register to this event. Admin will contact you later!',
					'header'=>'Operation Success',
					'status'=>'success'
				]);
			}
		}else {
			return redirect('/')->with([
				'status'=>'You already register to this event!',
				'header'=>'Oops! Something went wrong!',
				'status'=>'error'
			]);
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