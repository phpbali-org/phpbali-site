<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['photos'];

    protected $casts = [
        'is_staff' => 'boolean',
        'is_admin' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'auth_token',
    ];

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'user_id');
    }

    public function avatar()
    {
        switch ($this->provider_name) {
            case 'github':
                return $this->photos;
                break;
            default:
                return gravatar_url($this->email);
                break;
        }
    }

    public function isStaff()
    {
        return $this->is_staff === true;
    }

    public function isAdmin()
    {
        return $this->is_admin === true;
    }
}
