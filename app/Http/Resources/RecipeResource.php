<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? route('recipes.image', $this->id).'?'.$this->updated_at->timestamp : null,
            'url' => $this->url,
            'likes' => $this->likes ?? 0,
            'categories' => CategoryResource::collection($this->categories),
            'updated_at' => $this->updated_at->diffForHumans(),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
