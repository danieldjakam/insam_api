<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialityResource extends JsonResource
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
            'id'       => $this->id,
            'level'    => $this->level,
            'libele'   => $this->libele,
            'level_id' => $this->levels_id,
            'cours'        => $this->cours,
            'created_at' => $this->created_at,
        ];
    }
}
