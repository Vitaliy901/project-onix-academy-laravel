<x-post-layout>
	<x-slot:title>
		{{ ($flag == 'create') ? __('post.new_post') : __('post.edit_post');}}
	</x-slot:title>

	<div class="container">
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

		<div class="card">
			<h5 class="card-header info-color white-text text-center py-4">
				<strong>{{ ($flag == 'create') ? __('post.new_post') : __('post.edit_post');}}</strong>
			</h5>
			<div class="card-body px-lg-5 pt-0">
				<form action="{{ ($flag == 'create') ? route('posts.store') : route('posts.update', $post); }}" method="POST" class="md-form" style="color: #757575;">
					@csrf
					<label for="materialSaveFormName">{{ __('post.title') }}</label>
					<input type="text" name="title" value="{{ ($flag == 'create') ? old('title') : $post->title;}}" id="materialSaveFormName" class="form-control">
					<label for="materialSaveFormMessage">{{ __('post.text') }}</label>
					<textarea type="text" name="text" id="materialSaveFormMessage" class="form-control md-textarea" rows="7">{{ ($flag == 'create') ? old('text') : $post->text;}}</textarea>
					<input type="submit" class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" value="{{ ($flag == 'create') ? __('post.create_post') : __('post.bt_edit_post') ;}}"></a>
					<input type="hidden" name="_method" value="PATCH">
				</form>
			</div>
		</div>
	</div>
</x-post-layout>