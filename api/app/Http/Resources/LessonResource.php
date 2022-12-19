<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'id'         => $this->id,
            'title'      => $this->title,
            'cours'      => $this->cours,
            'cours_id'   => $this->cours_id,
            'created_at' => $this->created_at,
            'image_path' => $this->image_path,
            'video_path' => $this->video_path,
        ];
    }
}
