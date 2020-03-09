<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeCustomer extends JsonResource
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
            'address'              => $this->address,
            'balance'              => $this->balance,
            'created'              => $this->created,
            'currency'             => $this->currency,
            'default_source'       => $this->default_source,
            'delinquent'           => $this->delinquent,
            'description'          => $this->description,
            'discount'             => $this->discount,
            'email'                => $this->email,
            'invoice_prefix'       => $this->invoice_prefix,
            'invoice_settings_custom_fields'          
                                   => $this->invoice_settings->custom_fields,
            'invoice_settings_default_payment_method' 
                                   => $this->invoice_settings->default_payment_method,
            'invoice_settings_footer' 
                                   => $this->invoice_settings->footer,
            'livemode'             => $this->livemode,
            'metadata'             => $this->metadata,
            'name'                 => $this->name,
            'phone'                => $this->phone,
            'preferred_locales'    => $this->preferred_locales,
            'shipping'             => $this->shipping,  
            'sources_object'       => $this->sources->object,
            'sources_data'         => $this->sources->data,
            'sources_has_more'     => $this->sources->has_more,
            'sources_url'          => $this->sources->url,
            'subscriptions_object' => $this->subscriptions->object, 
            'subscriptions_data'   => $this->subscriptions->data, 
            'subscriptions_has_more' 
                                   => $this->subscriptions->has_more, 
            'subscriptions_url'    => $this->subscriptions->url, 
            'tax_exempt'           => $this->tax_exempt,
            'tax_ids_object'       => $this->tax_ids->object, 
            'tax_ids_data'         => $this->tax_ids->data, 
            'tax_ids_has_more'     => $this->tax_ids->has_more, 
            'tax_ids_url'          => $this->tax_ids->url, 
        ];
    }
}