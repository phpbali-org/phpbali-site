<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\Topics;
use App\Reservation;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Events::where('published',1)
                ->orderBy('created_at','desc')
                ->with('topic')
                ->with('rsvp')
                ->first();
        if ($event) {
            $topics = Topics::where('id_event',$event->id)
                    ->where('deleted',0)
                    ->get();

            $count = Reservation::where('id_events',$event->id)->count();
            $rsvp = Reservation::with('user')->get();
        }else {
            $topics = [];
            $count = 0;
            $rsvp = [];
        }
        return view('welcome',[
            'event'=>$event,
            'topics' => $topics,
            'count' => $count,
            'rsvp' => $rsvp
        ]);
    }
}
