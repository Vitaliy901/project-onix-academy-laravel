<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePostRequest;
use App\Http\Requests\Api\UpdatePostRequest;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all()->take(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {	

		$post = Post::create($request->safe()->merge(['user_id'=> Auth::id()])->except('cover'));

		if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
			
			$coverPath = $request->cover->store('public/covers');
			
			$cover = Image::create([
				'cover' => $coverPath,
				'post_id' => $post->id,
			]);
			return response()->json([
				'success' => true,
				'message' => 'Post created successfully.',
				'data' => $post,
				'image' => $cover,
				
			]);
		}

		return response()->json([
			'success' => true,
			'message' => 'Post created successfully.',
			'data' => $post,
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

		$post->update($request->safe()->except('cover'));
		
		return response()->json([
			'success' => true,
			'message' => 'Post updated successfully.',
			'data' => $post->refresh(),
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
		$post->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Post deleted successfully.',
			'data' => $post,
		]);
    }
}
