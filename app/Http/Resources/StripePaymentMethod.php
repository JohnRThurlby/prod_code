<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripePaymentMethod extends JsonResource
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
            'billing_details_address_city'
                                   => $this->billing_details->address->city,
            'billing_details_address_country'
                                   => $this->billing_details->address->country,
            'billing_details_address_line1'
                                   => $this->billing_details->address->line1,
            'billing_details_address_line2'
                                   => $this->billing_details->address->line2,
            'billing_details_address_postal_code'
                                   => $this->billing_details->address->postal_code,
            'billing_details_address_state'
                                   => $this->billing_details->address->state,
            'billing_details_email'
                                   => $this->billing_details->email,
            'billing_details_name'
                                   => $this->billing_details->name,
            'billing_details_phone'
                                   => $this->billing_details->phone,
            'card_brand'           => $this->card->brand,
            'card_checks_address_line1_check'     
                                   => $this->card->address_line1_check,
            'card_checks_postal_code_check'     
                                   => $this->card->postal_code_check,
            'card_checks_cvc_check'     
                                   => $this->card->cvc_check,
            'card_country'         => $this->card->country,
            'card_exp_month'       => $this->card->exp_month,
            'card_exp_year'        => $this->card->exp_year,
            'card_fingerprint'     => $this->card->fingerprint,
            'card_funding'         => $this->card->funding,
            'card_generated_from'  => $this->card->generated_from,
            'card_last4'           => $this->card->last4,
            'card_three_d_secure_usage_supported'
                                   => $this->card->three_d_secure_usage->supported,
            'card_wallet'          => $this->card->wallet,
            'created'              => $this->created,
            'customer'             => $this->customer,
            'livemode'             => $this->livemode,
            'metadata_order_id'    => $this->metadata->order_id,
            'type'                 => $this->type,
        ];
    }
}