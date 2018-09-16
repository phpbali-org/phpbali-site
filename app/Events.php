<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    
    protected $fillable = [
        'slug', 'name', 'desc', 'start_date', 'end_date', 'place', 'place_name',
        'latitude', 'longitude', 'published', 'deleted', 'photos', 'mobile_photos'
    ];

    public function topic()
    {
        return $this->hasMany("App\Topics", "event_id");
    }

    public function speakers()
    {
        return $this->topic->speakers;
    }

    public function rsvp()
    {
        return $this->hasMany("App\Reservation", "event_id");
    }
}
