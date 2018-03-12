<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Events;

class Topics extends Model
{
    protected $table = 'topics';
    protected $fillable = ['slug', 'id_event', 'title', 'meetup', 'desc', 'deleted'];

    public function speakers()
    {
    	return $this->belongsToMany('App\User', 'topic_speaker', 'id_topic', 'id_user')->withTimestamps();
    }

    public function namaEvent()
    {
    	return $this->belongsTo('App\Events', 'id_event');
    }
}
