<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'events';

    protected $fillable = [
        'slug',
        'name',
        'desc',
        'start_datetime',
        'end_datetime',
        'place',
        'place_name',
        'latitude',
        'longitude',
        'published',
        'deleted',
        'photos',
        'mobile_photos',
    ];

    public function topic()
    {
        return $this->hasMany(Topic::class, 'event_id');
    }

    public function speakers()
    {
        return $this->topic->speakers;
    }

    public function rsvp()
    {
        return $this->hasMany(Reservation::class, 'event_id');
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
