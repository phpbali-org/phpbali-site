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
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback($events = null, $event_slug = null)
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ada masalah, silahkan dicoba lagi.');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if (!empty($existingUser)) {
            // Update provider name and id if existing user login with Github
            if (empty($existingUser->provider_name)) {
                $existingUser->provider_name = 'github';
                $existingUser->provider_id = $user->getId();
            }

            Auth::login($existingUser, true);
        } else {
            $newUser = new User;
            $newUser->provider_name = 'github';
            $newUser->provider_id = $user->getId();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->photos = $user->getAvatar();

            $newUser->save();

            Auth::login($newUser, true);
        }

        if (!empty($events) && !empty($event_slug)) {
            $event = Event::where('slug', $event_slug)->first();
            // Check if event is exists and has not finished yet.
            if (!empty($event) && !$event->hasFinished()) {
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
