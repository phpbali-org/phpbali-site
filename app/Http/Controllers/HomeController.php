<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Events::where('published',1)->orderBy('created_at','desc')->first();
        return view('welcome',['event'=>$event]);
    }
}
