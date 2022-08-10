<div class="card text-center">
	<div class="card-header">
		<div class="btn-group" role="group" aria-label="Basic outlined example">
			@if (auth()->check())
			<a href="{{ route('posts.create') }}" class="btn btn-outline-primary">{{ __('post.new_post') }}</a>
			@endif
			<a class="btn btn-outline-primary" href="{{ route('posts.index') }}">{{ __('post.all_posts') }}</a>
			<a class="btn btn-outline-primary" href="{{ route('lang', __('post.new_lang')) }}">{{ __('post.new_lang') }}</a>
		</div>
	</div>
</div>