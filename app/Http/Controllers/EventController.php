<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $title = 'Daftar Acara';

        if (auth()->check() && (auth()->user()->isStaff() || auth()->user()->isAdmin())) {
            $events = Event::orderBy('created_at', 'desc')->get();
        } else {
            $events = Event::where('published', 1)
                // ->where('end_datetime', '<', \Carbon\Carbon::parse(new \DateTime('Asia/Makassar')))
                ->orderBy('end_datetime', 'desc')
                ->limit(10)
                ->get();
        }

        return view('pages.events', compact('title', 'events'));
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
            'name'           => 'required',
            'desc'           => 'required',
            'place_name'     => 'required',
            'address'        => 'required',
            'start_datetime' => 'required',
            'end_datetime'   => 'required',
        ]);

        $event = new Event();

        $event->name = $request->name;
        $event->desc = $request->desc;
        $event->place_name = $request->place_name;
        $event->address = $request->address;

        $event->start_datetime = $request->start_datetime;
        $event->end_datetime = $request->end_datetime;

        // Slug
        $event->slug = Event::createSlug($request->name);

        $event->save();

        return redirect($event->path());
    }

    /**
     * Show event.
     *
     * @param Event $event [description]
     *
     * @return [type] [description]
     */
    public function show(Event $event)
    {
        $topics = $event->topics()->get();

        return view('components.event.page', compact('event', 'topics'));
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
        return view('app.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event        $event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event, Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'desc'           => 'required',
            'place_name'     => 'required',
            'address'        => 'required',
            'start_datetime' => 'required',
            'end_datetime'   => 'required',
        ]);

        $event = Event::where('id', $event->id)->first();

        $event->name = $request->name;
        $event->desc = $request->desc;
        $event->place_name = $request->place_name;
        $event->address = $request->address;

        $event->start_datetime = $request->start_datetime;
        $event->end_datetime = $request->end_datetime;

        // Slug
        $event->slug = Event::createSlug($request->name, $event->id);

        $event->save();

        return redirect($event->path());
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
        $result = $event->delete();

        if ($result) {
            return response()->json([
                'status'  => 'ok',
                'message' => 'Event ini berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Event ini gagal dihapus',
            ]);
        }
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

    public function register(Event $event)
    {
        // TODO: Add response that registration successful
        auth()->user()->reservation()->create([
            'event_id' => $event->id,
            'user_id'  => auth()->user()->id,
        ]);

        return redirect('/');
    }
}
