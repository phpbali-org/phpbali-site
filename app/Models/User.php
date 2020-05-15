<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = ['photos'];

    protected $casts = [
        'is_staff' => 'boolean',
        'is_admin' => 'boolean',
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
                return "https://avatars1.githubusercontent.com/u/{$this->provider_id}?v=4";
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

    public function scopeExists($query, $provider, $providerId, $email)
    {
        return $query->where(function ($query) use ($provider, $providerId) {
            $query->where('provider_name', $provider)
                        ->where('provider_id', $providerId);
        })
                ->orWhere(function ($query) use ($email) {
                    $query->where('email', $email);
                });
    }

    public function path()
    {
        return '/users/'.$this->id;
    }
}
