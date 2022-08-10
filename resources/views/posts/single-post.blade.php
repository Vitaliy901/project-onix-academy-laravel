<x-post-layout>
	<x-slot:title>
		Post
	</x-slot:title>

	<div class="container">
		<div class="card text-center">
			<div class="card-body">
				<h5 class="card-title">{{ $post->title }}</h5>
				<p class="card-text">{{ $post->text }}</p>
				@if (auth()->check() && auth()->id() === $post->user_id)
				<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">{{ __('post.bt_edit_post') }}</a>
				@endif
			</div>
			<time class="card-footer text-muted">{{ $post->created_at }}</time>
		</div>
	</div>

</x-post-layout>