<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'github_id', 'website','verified','about','verify_token','slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','auth_token'
    ];

    public function rsvp() {
        return $this->hasMany("App\Reservation","id_user");
    }

    public function avatar(){
        if($this->github_id)
        {
            return 'https://avatars2.githubusercontent.com/u/'.$this->github_id.'?v=4';
        }else{
            return '/img/avatar/'.$this->photos;
        }
    }
}
