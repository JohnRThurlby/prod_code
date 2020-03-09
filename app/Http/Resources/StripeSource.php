<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeSource extends JsonResource
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
            'ach_credit_transfer_account_number'  
                                   => $this->ach_credit_transfer->account_number,
            'ach_credit_transfer_routing_number' 
                                   => $this->ach_credit_transfer->routing_number,
            'ach_credit_transfer_fingerprint'  
                                   => $this->ach_credit_transfer->fingerprint,
            'ach_credit_transfer_bank_name'  
                                   => $this->ach_credit_transfer->bank_name,
            'ach_credit_transfer_swift_code'  
                                   => $this->ach_credit_transfer->swift_code,
            'amount'               => $this->amount,
            'client_secret'        => $this->client_secret,
            'created'              => $this->created,
            'currency'             => $this->currency,
            'flow'                 => $this->flow,
            'livemode'             => $this->livemode,
            'metadata'             => $this->metadata,
            'owner_address'        => $this->owner->address,
            'owner_email'          => $this->owner->email,
            'owner_name'           => $this->owner->name,
            'owner_phone'          => $this->owner->phone,
            'owner_verified_address'  
                                   => $this->owner->verified_address,
            'owner_verified_email'  
                                   => $this->owner->verified_email,
            'owner_verified_name'  => $this->owner->verified_name,
            'owner_verified_phone'  
                                   => $this->owner->verified_phone,
            'receiver_address'     => $this->receiver->address,
            'receiver_amount_charged'  
                                   => $this->receiver->amount_charged,
            'receiver_amount_received' 
                                  => $this->receiver->amount_received,
            'receiver_amount_returned'       
                                  => $this->receiver->amount_returned,
            'receiver_refund_attributes_method'  
                                  => $this->receiver->refund_attributes_method,
            'receiver_refund_attributes_status'  
                                  => $this->receiver->refund_attributes_status,
            'statement_descriptor'          
                                  => $this->statement_descriptor,
            'status'              => $this->status,
            'type'                => $this->type,
            'usage'               => $this->usage,
        ];
    }
}