<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeListRefunds extends JsonResource
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
            'object'                => $this->object,
            'data'                  => $this->data,
            'has_more'              => $this->has_more,
            'url'                   => $this->url,
         ];
    }
}
