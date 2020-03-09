<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeProduct extends JsonResource
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
            'id'                   => $this->id,
            'object'               => $this->object,
            'active'               => $this->active,
            'attributes'           => $this->attributes,
            'caption'              => $this->caption,
            'created'              => $this->created,
            'deactivate_on'        => $this->deactivate_on,
            'description'          => $this->description,
            'images'               => $this->images,
            'livemode'             => $this->livemode,
            'metadata'             => $this->metadata,
            'name'                 => $this->name,
            'package_dimensions'   => $this->package_dimensions,
            'shippable'            => $this->shippable,
            'statement_descriptor' => $this->statement_descriptor,
            'type'                 => $this->type,
            'unit_label'           => $this->unit_label,
            'updated'              => $this->updated,
            'url'                  => $this->url,  
        ];
       
    }
}
