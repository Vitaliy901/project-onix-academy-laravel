<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'text',
		'user_id',
	];

	protected $casts = [
		'created_at' => 'datetime:Y.m.d i:m:s',
		'updated_at' => 'datetime:Y.m.d i:m:s',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function tags()
	{
		return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
	}

	public function images()
	{
		return $this->morphMany(Image::class, 'imageable');
	}
}
