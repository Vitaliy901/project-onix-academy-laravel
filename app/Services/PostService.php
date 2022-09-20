<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostService
{
    public function create(FormRequest $request, array $data): Post
    {
        $post = Post::create($data);

        if ($request->hasFile('cover')) {

            $covers = [];

            foreach ($request->file('cover') as $file) {

                if ($file->isValid()) {
                    $covers[] = ['cover' => $file->store('public/covers')];
                }
            }
            $post->images()->createMany($covers);
        }

        return TagService::addTagsWhenCreate($request, $post);
    }

    public function update(FormRequest $request, Post $post): Post
    {
        $post->update($request->safe()->except('cover', 'tags'));

        return TagService::addTagsWhenUpdate($request, $post);
    }
}
