<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeScheduledSubscription extends JsonResource
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
        'id'                      => $this->id,
        'object'                  => $this->object,
        'canceled_at'             => $this->canceled_at,
        'completed_at'            => $this->completed_at,
        'created'                 => $this->created,
        'current_phase'           => $this->current_phase,
        'customer'                => $this->customer,
        'default_settings'        => $this->default_settings,
        'end_behavior'            => $this->end_behavior,
        'livemode'                => $this->livemode,
        'metadata'                => $this->metadata,
        'phases'                  => $this->phases,
        'released_at'             => $this->released_at,
        'released_subscription'   => $this->released_subscription,
        'status'                  => $this->status,
        'subscription'            => $this->subscription,
       ];
    }
}
