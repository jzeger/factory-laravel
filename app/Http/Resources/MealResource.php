<?php

namespace App\Http\Resources;

use App\Http\Resources\TagResource;
use App\Http\Resources\IngredientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $status = "created";

        if($request->diff_time && (strtotime($this->created_at) > $request->diff_time)){
            $status = "created";
        }

        if($request->diff_time && (strtotime($this->updated_at) > $request->diff_time)){
            $status = "modified";
        }

        if($request->diff_time && (strtotime($this->deleted_at) > $request->diff_time)){
            $status = "deleted";
        }

        if(($this->relationLoaded('category')) && isset($this->category->id)) {
            return [
                'id' => $this->id,
                'title' => $this->translation->title,
                'description' => $this->translation->description,
                'status' => $status,
                'category' => [
                    'id' => $this->category->id, 
                    'title' => $this->category->translation->title,
                    'slug' => $this->category->slug
                ],
                'tags' => TagResource::collection($this->whenLoaded('tags')),
                'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))
            ];
        } else if(($this->relationLoaded('category')) && !isset($this->category->id)) {
            return [
                'id' => $this->id,
                'title' => $this->translation->title,
                'description' => $this->translation->description,
                'status' => $status,
                'category' => NULL,
                'tags' => TagResource::collection($this->whenLoaded('tags')),
                'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))
            ];
        } else {
            return [
                'id' => $this->id,
                'title' => $this->translation->title,
                'description' => $this->translation->description,
                'status' => $status,
                'tags' => TagResource::collection($this->whenLoaded('tags')),
                'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))
            ];
        }
    }
}
