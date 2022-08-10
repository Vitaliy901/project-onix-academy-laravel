<?php

namespace App\Providers;

use App\View\Components\Guest;
use App\View\Components\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Blade::component(Guest::class, 'guest-layout');
		Blade::component(Post::class, 'post-layout');

		Paginator::defaultView('components.bootstrap-5');
	}
}
