<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = "rsvp_events";
    protected $fillable= ['id_events','id_user'];

    public function events() {
    	return $this->belongsTo("App\Events","id_events");
    }

    public function user() {
    	return $this->belongsTo("App\User","id_user");
    }
}
