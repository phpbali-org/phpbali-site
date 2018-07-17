<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Events;

class Topics extends Model
{
    protected $table = 'topics';
    protected $fillable = ['slug', 'event_id', 'title', 'meetup', 'desc', 'deleted'];

    public function speakers()
    {
    	return $this->belongsToMany('App\User', 'topic_speaker', 'topic_id', 'user_id')->withTimestamps();
    }

    public function event()
    {
    	return $this->belongsTo('App\Events', 'event_id');
    }
}
