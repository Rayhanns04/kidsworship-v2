<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildrenAuthResource extends JsonResource
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
            "id" => $this->id,
            "email" => $this->email,
            "fullname" => $this->fullname,
            "old" => $this->old,
            "number_child" => $this->number_child,
            "graybeard" => [
                "id" => $this->Graybeard->id,
                "fullname" => $this->Graybeard->fullname,
            ]
        ];
    }
}
