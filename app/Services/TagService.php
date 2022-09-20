<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class TagService
{
    protected static $oldTags;

    protected static $newTags;

    protected static $tagsId;

    public static function addTagsWhenCreate(FormRequest $request, Post $post): Post
    {
        if ($request->filled('tags')) {

            if (!self::getNewTags($request)->isEmpty()) {

                $createdTags = $post->tags()->createMany(self::$newTags);

                $arrTags = collect($createdTags)->pluck('name', 'id');

                self::$tagsId = self::$oldTags->union($arrTags)->keys();

                $post->tags()->sync(self::$tagsId);
            } else {
                $post->tags()->attach(self::$oldTags->keys());
            }
            $post->load('tags');
        }
        return $post;
    }

    public static function addTagsWhenUpdate(FormRequest $request, $post)
    {
        if ($request->filled('tags')) {

            if (!self::getNewTags($request)->isEmpty()) {
                $post->tags()->createMany(self::$newTags);

                self::$tagsId = self::$oldTags
                    ->union($post->tags->pluck('name', 'id'))
                    ->keys();
            } else {
                self::$tagsId = $post
                    ->tags()
                    ->pluck('name', 'id')
                    ->union(self::$oldTags)
                    ->keys();
            }
            $post->tags()->sync(self::$tagsId);
        }
        return $post;
    }

    protected static function getNewTags(FormRequest $request): Collection
    {
        self::$oldTags = Tag::whereIn('name', $request->tags)->pluck('name', 'id');

        self::$newTags = $request->collect('tags')
            ->diff(self::$oldTags)
            ->map(function ($value) {
                return ['name' => $value];
            });

        return self::$newTags;
    }
}
