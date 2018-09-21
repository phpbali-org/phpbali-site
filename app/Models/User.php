<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Reservation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'github_id', 'photos', 'website','verified','about','verify_token','slug', 'is_staff'
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
        return $this->hasMany(Reservation::class, "id_user");
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
