<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $event = Events::where('published', 1)->orderBy('created_at', 'desc')->first();
        if(isset($event)){
            $rsvpChecker = Reservation::where('id_events', $event->id)->where('id_user', Auth::id())->count();
        }else{
            $rsvpChecker = 0;
        }
        return view('welcome')
        ->with('event', $event)
        ->with('rsvpChecker', $rsvpChecker);
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