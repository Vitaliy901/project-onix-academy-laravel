<x-post-layout>
	<x-slot:title>
		Posts
	</x-slot:title>

	<div class="container">
		@foreach ($posts as $post)
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h5>
				<p class="card-text">{{ $post->text }}</p>
				<time class="text-muted">{{ $post->created_at }}</time>
			</div>
		</div>
		@endforeach
	</div>
	<div class="container">
		{{ $posts->links() }}
	</div>

</x-post-layout>