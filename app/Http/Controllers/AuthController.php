<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider, $events = null, $event_slug = null)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Ada masalah, silahkan dicoba lagi.');
        }

        $existingUser = User::exists($provider, $user->getId(), $user->getEmail())->first();

        if (!empty($existingUser)) {
            // Update provider name and id if existing user login with Github
            if (empty($existingUser->provider_name)) {
                $existingUser->provider_name = $provider;
                $existingUser->provider_id = $user->getId();
                $existingUser->photos = $user->getAvatar();
            }

            $existingUser->username = !empty($existingUser->username) ? $existingUser->username : $user->getNickname();
            $existingUser->save();

            Auth::login($existingUser, true);
        } else {
            $newUser = new User();
            $newUser->provider_name = $provider;
            $newUser->provider_id = $user->getId();
            $newUser->name = !empty($user->getName()) ? $user->getName() : $user->getNickname();
            $newUser->email = !empty($user->getEmail()) ? $user->getEmail() : 'no-email@phpbali.com';
            $newUser->photos = $user->getAvatar();
            $newUser->username = $user->getNickname();

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
                        'user_id'  => auth()->user()->id,
                        'event_id' => $event->id,
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
