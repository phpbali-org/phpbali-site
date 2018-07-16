<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Events;
use App\Topics;
use App\Reservation;
use App\Conduct;
use App\User;
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
        $event = Events::with('rsvp')
        ->where('published', 1)
        ->where('deleted', 0)
        ->orderBy('created_at', 'desc')
        ->first();
        if(isset($event)){
            $rsvpChecker = Reservation::where('id_events', $event->id)->where('id_user', Auth::id())->count();
        }else{
            $rsvpChecker = 0;
        }
        $rsvpCounter = 0;
        foreach($event->rsvp as $rsvp){
            if (!empty($rsvp->user->name)) {
                $rsvpCounter = $rsvpCounter + 1;
            } 
        }
        return view('welcome')
        ->with('event', $event)
        ->with('rsvpChecker', $rsvpChecker)
        ->with('rsvpCounter', $rsvpCounter);
    }

    public function meetups() 
    {
        $event = Events::where('published', 1)->orderBy('created_at', 'desc')->get();
        if(isset($event)){
            $events = $event;
            $is_register = 0;
        }else{
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