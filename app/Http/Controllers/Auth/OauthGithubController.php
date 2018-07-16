<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Socialite;
use Redirect;

class OauthGithubController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to(route('oauth.github.provider'));
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to(route('index'));
    }   

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser)
    {
         $checkUser = User::where('github_id', $githubUser->getId())
        ->first();

        if ($checkUser) {
            return $checkUser;
        }else{
            $checkAgain = User::where('email', $githubUser->getEmail())
            ->first();
            if($checkAgain){
                $checkAgain->update([
                    'name' => $githubUser->getName(),
                    'email' => $githubUser->getEmail(),
                    'slug' => str_slug($githubUser->getName()),
                    'github_id' => $githubUser->getId(),
                    'photos' => $githubUser->getAvatar(),
                    'verify_token' => str_random(60), 
                ]);
                
                return $checkAgain;
            }else{
                return User::create([
                    'name' => $githubUser->getName(),
                    'email' => $githubUser->getEmail(),
                    'slug' => str_slug($githubUser->getName()),
                    'github_id' => $githubUser->getId(),
                    'photos' => $githubUser->getAvatar(),
                    'verify_token' => str_random(60),
                    'verified' => 1
                ]);
            }
        }
    }
}