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

    public function eventDate()
    {
        $start_datetime = \Carbon\Carbon::parse($this->start_datetime, 'Asia/Makassar')->locale('id');
        $end_datetime = \Carbon\Carbon::parse($this->end_datetime, 'Asia/Makassar')->locale('id');

        if ($start_datetime->isSameDay($end_datetime)) {
            return $start_datetime->isoFormat('LL');
        } else if (!$start_datetime->isSameDay($end_datetime) && $start_datetime->isSameMonth($end_datetime))  {
            return $start_datetime->day . '-' . $end_datetime->day . $start_datetime->monthName . $start_datetime->year;
        } else {
            return $start_datetime->day . $start_datetime->monthName . '-' . $end_datetime->day . $end_datetime->monthName . $end_datetime->year;
        }
    }

    public function eventTime()
    {
        $start_datetime = \Carbon\Carbon::parse($this->start_datetime, 'Asia/Makassar')->locale('id');
        $end_datetime = \Carbon\Carbon::parse($this->end_datetime, 'Asia/Makassar')->locale('id');

        return $start_datetime->format('H:i') . ' - ' . $end_datetime->format('H:i') . ' WITA';
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
}
