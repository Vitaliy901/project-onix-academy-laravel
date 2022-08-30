<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = 'post';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'keywords' => $this->whenNotNull($this->keywords),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'images' => $this->when(
                !$this->images->isEmpty() && $this->whenLoaded('images'),
                ImageResource::collection($this->images)
            ),
            'user' => new UserResource($this->whenLoaded('user')),
            'tags' => $this->when(
                !$this->tags->isEmpty() && $this->whenLoaded('tags'),
                TagResource::collection($this->tags)
            ),
        ];
    }
}
