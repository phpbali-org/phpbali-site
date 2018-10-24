<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Conduct;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::with('rsvp')
        ->where('published', 1)
        ->where('deleted', 0)
        ->orderBy('created_at', 'desc')
        ->first();
        if (isset($event)) {
            $rsvpChecker = Reservation::where('event_id', $event->id)->where('user_id', Auth::id())->count();
        } else {
            $rsvpChecker = 0;
        }
        $rsvpCounter = 0;
        if (!empty($event->rsvp)) {
            foreach ($event->rsvp as $rsvp) {
                if (!empty($rsvp->user->name)) {
                    $rsvpCounter = $rsvpCounter + 1;
                }
            }
        }
        return view('welcome')
        ->with('event', $event)
        ->with('rsvpChecker', $rsvpChecker)
        ->with('rsvpCounter', $rsvpCounter);
    }

    public function meetups()
    {
        $event = Event::where('published', 1)->orderBy('created_at', 'desc')->get();
        if (isset($event)) {
            $events = $event;
            $is_register = 0;
        } else {
            $rsvpChecker = 0;
        }
        return view('pages.meetups')
        ->with('events', $events)
        ->with('rsvpChecker', $is_register);
    }

    public function codeofconduct()
    {
        $conduct = Conduct::first();
        $organiser = User::where('is_staff', 1)->get();
        return view('pages.codeconduct')
        ->with('conduct', $conduct)
        ->with('organiser', $organiser);
    }
}
