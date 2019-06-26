<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a view page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $users = User::all();

        return view('app.topics.create', compact('users', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, Request $request)
    {
        $request->validate([
            'title'      => 'required',
            'desc'       => 'required',
            'speakers'   => 'required|array|min:1',
            'speakers.*' => 'required|min:1',
        ]);

        $topic = new Topic();

        $topic->title = $request->title;
        $topic->desc = $request->desc;
        $topic->slug = Topic::createSlug($request->title);
        $topic->event_id = $event->id;

        $topic->save();

        $topic->speakers()->sync($request->speakers);

        return redirect($event->path());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Topic        $topic
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Topic $topic, Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
    }
}
