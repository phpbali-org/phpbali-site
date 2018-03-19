<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $fillable = ['slug', 'name', 'desc', 'start_date', 'end_date', 'place', 'place_name', 'latitude', 'longitude', 'published', 'deleted','photos'];

    public function topic() {
    	return $this->hasMany("App\Topics");
    }
}
