<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $grouped =
            GCPResource::collection($this->Prayers)->groupBy([function ($item, $key) {
                // dd(substr($item['date'], 0, 4));
                // dd(Str::substr($item['date'], 0, 6));
                $year = substr($item['date'], 0, 6) . '01';
                $result = substr($year, 0, 5);

                return $result;
            }, 'month']);

        return [
            'id' =>  $this->id,
            'fullname' => $this->fullname,
            'old' => $this->old,
            'number_child' => $this->number_child,
            'prayers' => $grouped->toArray()
        ];
    }
}
