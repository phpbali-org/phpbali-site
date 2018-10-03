<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\User;

class Reservation extends Model
{
    protected $table = "rsvp_events";
    protected $fillable= ['event_id','user_id'];

    public function events() {
    	return $this->belongsTo(Event::class, "event_id");
    }

    public function user() {
    	return $this->belongsTo(User::class, "user_id");
    }
}
