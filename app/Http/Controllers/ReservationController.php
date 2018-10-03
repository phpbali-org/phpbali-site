<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Auth;
use App\Models\Event;

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

    public function rsvp($slug)
    {
        $event = Event::where('slug', $slug)->first();
        $rsvpChecker = Reservation::where('event_id', $event->id)->where('user_id', Auth::id())->count();
        if ($rsvpChecker < 1) {
            $rsvp = $this->createReservation($event->id, Auth::guard('web')->user()->id);
            if ($rsvp) {
                return redirect()->back()->with([
                    'msg'=>'Thank you for register to this event. Admin will contact you later!',
                    'header'=>'Operation Success',
                    'status'=>'success'
                ]);
            }
        } else {
            return redirect('/')->with([
                'status'=>'You already register to this event!',
                'header'=>'Oops! Something went wrong!',
                'status'=>'error'
            ]);
        }
    }

    protected function createReservation($event_id, $user_id)
    {
        return Reservation::firstOrCreate([
            'event_id'    => $event_id,
            'user_id'    => $user_id
        ]);
    }
}
