<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeTaxRate extends JsonResource
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
            'id'                => $this->id,
            'object'            => $this->object,
            'active'            => $this->active,
            'created'           => $this->created,
            'description'       => $this->description,
            'display_name'      => $this->display_name,
            'inclusive'         => $this->inclusive,
            'jurisdiction'      => $this->jurisdiction,
            'livemode'          => $this->livemode,
            'metadata'          => $this->metadata,
            'percentage'        => $this->percentage,
        ];
    }
}
