<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeSubscription extends JsonResource
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
        'application_fee_percent' => $this->application_fee_percent,
        'billing_cycle_anchor'    => $this->billing_cycle_anchor,
        'billing_thresholds'      => $this->billing_thresholds,
        'cancel_at'               => $this->cancel_at,
        'cancel_at_period_end'    => $this->cancel_at_period_end,
        'canceled_at'             => $this->canceled_at,
        'collection_method'       => $this->collection_method,
        'created'                 => $this->created,
        'current_period_end'      => $this->current_period_end,
        'current_period_start'    => $this->current_period_start,
        'customer'                => $this->customer,
        'days_until_due'          => $this->days_until_due,
        'default_payment_method'  => $this->default_payment_method,
        'default_source'          => $this->default_source,
        'default_tax_rates'       => $this->default_tax_rates,
        'discount'                => $this->discount,
        'ended_at'                => $this->ended_at,
        'items'                   => $this->items,
        'latest_invoice'          => $this->latest_invoice,
        'livemode'                => $this->livemode,
        'metadata'                => $this->metadata,
        'next_pending_invoice_item_invoice'
                                  => $this->next_pending_invoice_item_invoice,
        'pending_invoice_item_interval' 
                                  => $this->pending_invoice_item_interval,
        'pending_setup_intent'    => $this->pending_setup_intent,
        'plan'                    => $this->plan,
        'quantity'                => $this->quantity,
        'schedule'                => $this->schedule,
        'start_date'              => $this->start_date,
        'status'                  => $this->status,
        'tax_percent'             => $this->tax_percent,
        'trial_end'               => $this->trial_end,
        'trial_start'             => $this->trial_start,
       ];
    }
}