<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Common extends JsonResource
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
            'data' => parent::toArray($request),
            'meta' => [
                'settings_hash' => get_settings_hash(),
            ],
        ];
    }
}
