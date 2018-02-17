<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;
    protected $table = 'articles';
    protected $fillable = [
    	'thumbnail','title','description','content',
		'slug','published','published_at'
	];

	protected $dates = ['deleted_at','published_at'];

	protected $casts = [
		'published'		=> 'boolean'
	];

	public function scopePublished($query)
	{
		return $query->where([
			'published' => true
		]);
	}

	public function scopeMine($query, $user_id)
	{
		return $query->where('user_id',$user_id);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public static function loadAll()
	{
		return static::latest()
			->paginate();
	} 

	public static function loadAllMine($user_id)
	{
		return static::latest()
			->mine($user_id)
			->paginate();
	}

	public static function loadAllPublished()
	{
		return static::with(['user' => function($query) {
			$query->select('id','first_name','last_name');
		}])
			->latest()
			->published()
			->paginate();
	}

	public static function loadPublished($slug)
	{
		return static::with([
			'user' => function ($query) {
				$query->select('id','first_name','last_name');
			}
		])
			->published()
			->where('slug',$slug)
			->firstOrFail();
	}
}
