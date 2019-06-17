<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['photos'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'auth_token',
    ];

    public function avatar()
    {
        if (isset($this->github_id)) {
            return 'https://avatars2.githubusercontent.com/u/'.$this->github_id.'?v=4';
        } else {
            return gravatar_url($this->email);
        }
    }
}
