<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeCharge extends JsonResource
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
            'amount'               => $this->amount,

            'amount_refunded'      => $this->object,
            'application'          => $this->application,
            'application_fee'      => $this->application_fee,
            'application_fee_amount' 
                                   => $this->application_fee_amount,
            'balance_transaction'  => $this->balance_transaction,
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
            'captured'             => $this->captured,
            'created'              => $this->created,
            'currency'             => $this->currency,
            'customer'             => $this->customer,
            'description'          => $this->description,
            'dispute'              => $this->dispute,
            'disputed'             => $this->disputed,
            'failure_code'         => $this->failure_code,
            'failure_message'      => $this->failure_message,
            'fraud_details'        => $this->fraud_details,
            'invoice'              => $this->invoice,
            'livemode'             => $this->livemode,
            'metadata'             => $this->metadata,
            'on_behalf_of'         => $this->on_behalf_of,
            'order'                => $this->order,
            'outcome_network_status'          
                                   => $this->outcome->network_status,
            'outcome_reason'       => $this->outcome->reason,
            'outcome_risk_level'   => $this->outcome->risk_level,
            'outcome_risk_score'   => $this->outcome->risk_score,
            'outcome_rule'         => $this->outcome->rule,
            'outcome_seller_message' 
                                   => $this->outcome->seller_message,
            'outcome_type'         => $this->outcome->type,
            'paid'                 => $this->paid,
            'payment_intent'       => $this->payment_intent,
            'payment_method'       => $this->payment_method,
            'payment_method_details_card_brand'           
                                   => $this->payment_method_details->card->brand,
            'payment_method_details_card_checks_address_line1_check'     
                                   => $this->payment_method_details->card->checks->address_line1_check,
            'payment_method_details_card_checks_postal_code_check'     
                                   => $this->payment_method_details->card->checks->address_postal_code_check,
            'payment_method_details_card_checks_cvc_check'     
                                   => $this->payment_method_details->card->checks->cvc_check,
            'payment_method_details_card_country'         
                                   => $this->payment_method_details->card->country,
            'payment_method_details_card_exp_month'
                                   => $this->payment_method_details->card->exp_month,
            'payment_method_details_card_exp_year'
                                   => $this->payment_method_details->card->exp_year,
            'payment_method_details_card_fingerprint'
                                   => $this->payment_method_details->card->fingerprint,
            'payment_method_details_card_funding'
                                   => $this->payment_method_details->card->funding,
            'payment_method_details_card_installments'
                                   => $this->payment_method_details->card->installments,
            'payment_method_details_card_last4'
                                   => $this->payment_method_details->card->last4,
            'payment_method_details_card_network'
                                   => $this->payment_method_details->card->network,
            'payment_method_details_card_three_d_secure'
                                   => $this->payment_method_details->card->three_d_secure,
            'payment_method_details_card_wallet'         
                                   => $this->payment_method_details->card->wallet,
            'payment_method_details_type'                 
                                   => $this->payment_method_details->type,
            'receipt_email'        => $this->receipt_email,
            'receipt_number'       => $this->receipt_number,
            'receipt_url'          => $this->receipt_url,
            'refunded'             => $this->refunded,
            'refunds_object'       => $this->refunds->object,
            'refunds_data'         => $this->refunds->data,
            'refunds_has_more'     => $this->refunds->has_more,
            'refunds_url'          => $this->refunds->url,
            'review'               => $this->review,
            'shipping'             => $this->shipping,
            'source_transfer'      => $this->source_transfer,
            'statement_descriptor' => $this->statement_descriptor,
            'status'               => $this->status,
            'transfer_data'        => $this->transfer_data,
            'transfer_group'       => $this->transfer_group,
        ];
    }
}