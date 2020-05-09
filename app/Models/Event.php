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

    protected $hidden = ['photos', 'mobile_photos', 'latitude', 'longitude', 'place'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class, 'event_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'event_id');
    }

    public function eventDate()
    {
        $start_datetime = \Carbon\Carbon::parse($this->start_datetime, 'Asia/Makassar')->locale('id');
        $end_datetime = \Carbon\Carbon::parse($this->end_datetime, 'Asia/Makassar')->locale('id');

        if ($start_datetime->isSameDay($end_datetime)) {
            return $start_datetime->isoFormat('LL');
        } elseif (!$start_datetime->isSameDay($end_datetime) && $start_datetime->isSameMonth($end_datetime)) {
            return $start_datetime->day.'-'.$end_datetime->day.$start_datetime->monthName.$start_datetime->year;
        } else {
            return $start_datetime->day.$start_datetime->monthName.'-'.$end_datetime->day.$end_datetime->monthName.$end_datetime->year;
        }
    }

    public function eventTime()
    {
        $start_datetime = \Carbon\Carbon::parse($this->start_datetime, 'Asia/Makassar')->locale('id');
        $end_datetime = \Carbon\Carbon::parse($this->end_datetime, 'Asia/Makassar')->locale('id');

        return $start_datetime->format('H:i').' - '.$end_datetime->format('H:i').' WITA';
    }

    public function isOngoing()
    {
        $now = \Carbon\Carbon::parse(new \DateTime('Asia/Makassar'));
        $start_datetime = \Carbon\Carbon::parse($this->start_datetime, 'Asia/Makassar')->locale('id');
        $end_datetime = \Carbon\Carbon::parse($this->end_datetime, 'Asia/Makassar')->locale('id');

        return $now->between($start_datetime, $end_datetime);
    }

    public function hasFinished()
    {
        $now = \Carbon\Carbon::parse(new \DateTime('Asia/Makassar'));
        $end_datetime = \Carbon\Carbon::parse($this->end_datetime, 'Asia/Makassar')->locale('id');

        return $now->greaterThan($end_datetime);
    }

    // Get last event
    public static function lastEvent()
    {
        return self::where('published', 1)
        ->orderBy('created_at', 'desc')
        ->first();
    }

    // Get total reservations
    public function totalReservation()
    {
        return self::where('id', $this->id)
        ->first()
        ->reservations()
        ->count();
    }

    // Get total attendance
    public function totalAttendance()
    {
        return self::where('id', $this->id)
        ->first()
        ->reservations()
        ->whereNotNull('attended_at')
        ->count();
    }

    public function path()
    {
        return '/events/'.$this->slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Generate
    public static function createSlug($name, $id = 0)
    {
        // Normalize the name
        $slug = str_slug($name);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = self::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function scopeHasPublished($query)
    {
        return $query->where('published', 1);
    }
}
