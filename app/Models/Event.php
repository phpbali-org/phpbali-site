<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'slug',
        'name',
        'desc',
        'start_date',
        'end_date',
        'place',
        'place_name',
        'latitude',
        'longitude',
        'published',
        'deleted',
        'photos',
        'mobile_photos'
    ];

    public function topic()
    {
        return $this->hasMany(Topic::class, "event_id");
    }

    public function speakers()
    {
        return $this->topic->speakers;
    }

    public function rsvp()
    {
        return $this->hasMany(Reservation::class, "event_id");
    }

    public function photoUrl()
    {
        return \Storage::disk('bg-event')->url($this->photos);
    }

    public function mobilePhotoUrl()
    {
        return \Storage::disk('bg-event')->url($this->mobile_photos);
    }
}
