<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'title' => $this->title,
            'level' => $this->level,
            'lessons' => $this->lessons,
            'levels_id' => $this->levels_id,
            'created_at' => $this->created_at,
            'image_path' => $this->image_path,
            'speciality' => $this->speciality,
            'specialities_id' => $this->specialities_id,
        ];
    }
}
