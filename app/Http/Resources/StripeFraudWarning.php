<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeFraudWarning extends JsonResource
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
            'id'         => $this->id,
            'object'     => $this->object,
            'actionable' => $this->actionable,
            'charge'     => $this->charge,
            'created'    => $this->created,
            'fraud_type' => $this->fraud_type,
            'livemode'   => $this->livemode,
        ];
    }
}
