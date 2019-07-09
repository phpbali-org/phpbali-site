<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    const PRESENT = 1;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('app.attendees.create', compact('event'));
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
            'name'           => 'required',
            'email'           => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!empty($user)) {
            $user->reservation()->create([
                'user_id'  => $user->id,
                'event_id' => $event->id,
            ]);
        } else {
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;

            $newUser->save();

            $newUser->reservation()->create([
                'user_id' => $newUser->id,
                'event_id' => $event->id,
            ]);
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Event               $event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function attendance(Event $event)
    {
        $user = User::where('id', request()->input('participant_id'))->first();

        if (request()->input('has_attended') === self::PRESENT) {
            if (empty($event->reservations()->where('user_id', request()->input('participant_id'))->first()->attended_at)) {
                $event->reservations()->where('user_id', request()->input('participant_id'))->update([
                    'attended_at' => date('Y-m-d H:i:s', time()),
                ]);

                return response()->json([
                    'message' => "{$user->name} telah hadir",
                ]);
            } else {
                return response()->json([
                    'message' => "{$user->name} sudah hadir daritadi",
                ]);
            }
        } else {
            $event->reservations()->where('user_id', request()->input('participant_id'))->update([
                'attended_at' => null,
            ]);

            return response()->json([
                'message' => "{$user->name} batal hadir",
            ]);
        }
    }
}
