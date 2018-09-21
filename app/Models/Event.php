<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Topics;
use App\Models\Reservation;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'slug', 'name', 'desc', 'start_date', 'end_date', 'place', 'place_name',
        'latitude', 'longitude', 'published', 'deleted', 'photos', 'mobile_photos'
    ];

    public function topic()
    {
        return $this->hasMany(Topics::class, "event_id");
    }

    public function speakers()
    {
        return $this->topic->speakers;
    }

    public function rsvp()
    {
        return $this->hasMany(Reservation::class, "event_id");
    }
}
