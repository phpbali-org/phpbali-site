<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'topics';
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
