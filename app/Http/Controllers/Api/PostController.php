<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePostRequest;
use App\Http\Requests\Api\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('user', 'tags', 'images')
            ->text($request->text)
            ->title($request->title)
            ->tags($request->tags);

        return new PostCollection($posts->paginate(2));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->safe()
            ->merge(['user_id' => Auth::id()])
            ->except('cover', 'tags');

        $post = Post::create($data);

        if ($request->filled('tags')) {

            $dataIn = Tag::whereIn('name', $request->tags)->pluck('name', 'id');

            $newTags = $request->collect('tags')
                ->diff($dataIn)
                ->map(function ($value) {
                    return ['name' => $value];
                });

            if (!$newTags->isEmpty()) {

                $createdTags = $post->tags()->createMany($newTags);

                $arrTags = collect($createdTags)->pluck('name', 'id');

                $tagsID = $dataIn->union($arrTags)->keys();

                $post->tags()->sync($tagsID);
            } else {
                $post->tags()->attach($dataIn->keys());
            }

            $post->load('tags');
        }

        if ($request->hasFile('cover')) {

            $covers = [];

            foreach ($request->file('cover') as $file) {

                if ($file->isValid()) {
                    $covers[] = ['cover' => $file->store('public/covers')];
                }
            }

            $post->images()->createMany($covers);
        }

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->safe()->except('cover', 'tags'));

        if ($request->filled('tags')) {

            $dataIn = Tag::whereIn('name', $request->tags)->pluck('name', 'id');

            $newTags = $request->collect('tags')
                ->diff($dataIn)
                ->map(function ($value) {
                    return ['name' => $value];
                });

            if (!$newTags->isEmpty()) {

                $post->tags()->createMany($newTags);

                $tagsID = $post->tags()->allRelatedIds();
            } else {

                $tagsID = $post
                    ->tags()
                    ->pluck('name', 'id')
                    ->union($dataIn)
                    ->keys();
            }

            $post->tags()->sync($tagsID);
        }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
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
