<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Socialite;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider, Request $request)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ada masalah, silahkan dicoba lagi.');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if (!empty($existingUser)) {
            Auth::login($existingUser, true);
        } else {
            $newUser = new User;
            $newUser->provider_name = $provider;
            $newUser->provider_id = $user->getId();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->photos = $user->getAvatar();

            $newUser->save();

            Auth::login($newUser, true);
        }

        // Check if event slug is exist then find the event based on slug
        if ($request->has('event_slug')) {
            $event = Event::where('slug', $request->event_slug)->first();
            // If event is exist then register user to meetup event
            if (!empty($event)) {
                // Check if user doesn't register yet
                if ($event->reservations()->where('user_id', auth()->user()->id)->get()->isEmpty()) {
                    auth()->user()->reservation()->create([
                        'user_id' => auth()->user()->id,
                        'event_id' => $event->id
                    ]);
                }
            }
        }

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
