<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'topics';
    protected $fillable = ['slug', 'event_id', 'title', 'meetup', 'desc', 'deleted'];

    public function speakers()
    {
        return $this->belongsToMany(User::class, 'topic_speaker', 'topic_id', 'user_id')->withTimestamps();
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
