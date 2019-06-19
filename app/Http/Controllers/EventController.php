<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $title = 'Daftar Acara';

        $previous_events = Event::where('published', 1)
            ->where('end_datetime', '<', \Carbon\Carbon::parse(new \DateTime('Asia/Makassar')))
            ->orderBy('end_datetime', 'desc')
            ->limit(10)
            ->get();

        return view('activities', compact('title', 'previous_events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'place_name' => 'required',
            'address' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required'
        ]);

        $event = new Event;

        $event->name = $request->name;
        $event->desc = $request->desc;
        $event->place_name = $request->place_name;
        $event->address = $request->address;

        // Todo parsing input to datetime with carbon
        $event->start_datetime = $request->start_datetime;
        $event->end_datetime = $request->end_datetime;

        // Slug
        $event->slug = Event::createSlug($request->name);

        $event->save();

        return redirect($event->path());
    }

    /**
     * Show event
     * @param  Event  $event [description]
     * @return [type]        [description]
     */
    public function show(Event $event)
    {
        $topics = $event->topics()->get();

        return view('app.events.detail', compact('event', 'topics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event, Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {

    }

    // Publish event
    public function publish(Event $event)
    {
        $event->update(['published' => 1]);

        return redirect('/events');
    }

    // Unpublish event
    public function unpublish(Event $event)
    {
        $event->update(['published' => 0]);

        return redirect('/events');
    }
}
