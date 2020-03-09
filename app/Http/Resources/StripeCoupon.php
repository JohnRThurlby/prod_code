<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeCoupon extends JsonResource
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
            'amount_off'        => $this->amount_off,
            'created'           => $this->created,
            'currency'          => $this->currency,
            'duration'          => $this->duration,
            'duration_in_months'
                                => $this->duration_in_months,
            'livemode'          => $this->livemode,
            'max_redemptions'   => $this->max_redemptions,
            'metadata'          => $this->metadata,
            'name'              => $this->name,
            'percent_off'       => $this->percent_off,
            'redeem_by'         => $this->redeem_by,
            'times_redeemed'    => $this->times_redeemed,
            'valid'             => $this->valid,
        ];
    }
}
