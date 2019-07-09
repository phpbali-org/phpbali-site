<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function speakers()
    {
        return $this->belongsToMany(User::class, 'topic_speaker', 'topic_id', 'user_id')->withTimestamps();
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Generate
    public static function createSlug($name, $id = 0)
    {
        // Normalize the name
        $slug = str_slug($name);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = self::select('slug')->where('slug', 'like', '%'.$slug.'%')
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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
