<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'events';

    protected $guarded = ['photos', 'mobile_photos', 'latitude', 'longitude', 'place'];

    public function topics()
    {
        return $this->hasMany(Topic::class, 'event_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'event_id');
    }
}
