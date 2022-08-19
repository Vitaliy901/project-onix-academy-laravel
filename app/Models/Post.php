<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'title',
		'keywords',
		'text',
		'user_id',
	];

	protected $casts = [
		'created_at' => 'datetime:Y.m.d i:m:s',
		'updated_at' => 'datetime:Y.m.d i:m:s',
	];

	protected $hidden = [
		'deleted_at'
	];
}
