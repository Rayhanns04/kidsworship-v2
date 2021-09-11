<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GCResource extends JsonResource
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
            'id' =>  $this->id,
            'fullname' => $this->fullname,
            'old' => $this->old,
            'number_child' => $this->number_child,
            'prayers' => GCPResource::collection($this->Prayers)->groupBy(function ($item, $key) {
                return substr($item['date'], 0, 7);
            })
        ];
    }
}
