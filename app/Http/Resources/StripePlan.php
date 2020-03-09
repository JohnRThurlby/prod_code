<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripePlan extends JsonResource
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
            'aggregate_usage'   => $this->aggregate_usage,
            'amount'            => $this->amount,
            'amount_decimal'    => $this->amount_decimal,
            'billing_scheme'    => $this->billing_scheme,
            'created'           => $this->created,
            'currency'          => $this->currency,
            'interval'          => $this->interval,
            'interval_count'    => $this->interval_count,
            'livemode'          => $this->livemode,
            'metadata'          => $this->metadata,
            'nickname'          => $this->nickname,
            'product'           => $this->product,
            'tiers'             => $this->tiers,
            'tiers_mode'        => $this->tiers_mode,
            'transform_usage'   => $this->transform_usage,
            'trial_period_days' => $this->trial_period_days,
            'usage_type'        => $this->usage_type,
        ];
    }
}
