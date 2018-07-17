<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = "rsvp_events";
    protected $fillable= ['event_id','user_id'];

    public function events() {
    	return $this->belongsTo("App\Events","event_id");
    }

    public function user() {
    	return $this->belongsTo("App\User","user_id");
    }
}
