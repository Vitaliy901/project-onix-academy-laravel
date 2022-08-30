<?php

namespace App\Models;

use App\Models\Traits\RegisterGlobalScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasFactory, RegisterGlobalScope;

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

	public function scopeTitle(Builder $builder, $title)
	{
		return $builder->when($title, function ($query, $keywords) {
			$query->where('title', 'ILIKE', '%' . $keywords . '%');
		});
	}

	public function scopeText(Builder $builder, $text)
	{
		return $builder->when($text, function ($query, $keywords) {
			$query->where('text', 'ILIKE', '%' . $keywords . '%');
		});
	}

	public function scopeTags(Builder $builder, $tags)
	{
		return $builder->when($tags, function ($query) use ($tags) {
			$query->whereRelation('tags', 'name', 'ILIKE', '%' . $tags . '%');
		});
	}
}
