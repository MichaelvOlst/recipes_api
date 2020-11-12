<?php

namespace App\Http\Resources;

use App\Http\Resources\RecipeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            // 'recipes' => RecipeResource::collection($this->recipes),
            'recipes' => $this->recipes->count(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
