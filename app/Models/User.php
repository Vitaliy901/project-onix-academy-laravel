<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Events\UserRegistered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'first_name',
		'last_name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function posts()
	{
		return $this->hasMany(Post::class, 'user_id', 'id');
	}

	public function scopeEmail(Builder $builder, $email)
	{
		return $builder->when($email, function ($query, $keywords) {
			$query->where('email', 'ILIKE', $keywords . '%');
		});
	}

	public function scopeInterval(Builder $builder, $startDate, $endDate)
	{
		if ($startDate && $endDate) {

			$builder->whereBetween('created_at', [
				$startDate,
				$endDate,
			]);
		}
	}

	public function scopeAuthors(Builder $builder, $authors)
	{
		if ($authors === 'true') {
			$builder->has('posts');
		}
	}

	public function scopeSortBy(Builder $builder, $sortBy)
	{
		if ($sortBy === 'top') {
			$builder->orderByDesc('posts_count');
		}
	}

	protected static function booted()
	{
		static::saving(function ($user) {
			if ($user->first_name && $user->last_name) {
				$user->full_name = $user->first_name . ' ' . $user->last_name;
			}
		});

		static::created(function ($user) {
			UserRegistered::dispatch($user);
		});
	}
}
