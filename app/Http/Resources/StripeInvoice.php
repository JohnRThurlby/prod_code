<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeInvoice extends JsonResource
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
        'account_country'         => $this->account_country,
        'account_name'            => $this->account_name,
        'amount_due'              => $this->amount_due,
        'amount_paid'             => $this->amount_paid,
        'amount_remaining'        => $this->amount_remaining,
        'application_fee_amount'  => $this->application_fee_amount,
        'attempt_count'           => $this->attempt_count,
        'attempted'               => $this->attempted,
        'auto_advance'            => $this->auto_advance,

        'billing_reason'          => $this->billing_reason,
        'charge'                  => $this->charge,
        'collection_method'       => $this->collection_method,
        'created'                 => $this->created,
        'currency'                => $this->currency,
        'customm_fields'          => $this->customm_fields,
        'customer'                => $this->customer,
        'customer_address_city'   => $this->customer_address->city,
        'customer_address_country'
                                  => $this->customer_address->country,
        'customer_address_line1'  => $this->customer_address->line1,
        'customer_address_line2'  => $this->customer_address->line2,
        'customer_address_postal_code'
                                  => $this->customer_address->postal_code,
        'customer_address_state'  => $this->customer_address->state, 
        'customer_email'          => $this->customer_email, 
        'customer_name'           => $this->customer_name, 
        'customer_phone'          => $this->customer_phone, 
        'customer_shipping'       => $this->customer_shipping, 
        'customer_tax_exempt'     => $this->customer_tax_exempt, 
        'customer_tax_ids'        => $this->customer_tax_ids, 
        'default_payment_method'  => $this->default_payment_method,
        'default_source'          => $this->default_source,
        'default_tax_rates'       => $this->default_tax_rates,
        'description'             => $this->description,
        'discount'                => $this->discount,
        'due_date'                => $this->due_date,
        'ending_balance'          => $this->ending_balance,
        'footer'                  => $this->footer,
        'hosted_invoice_url'      => $this->hosted_invoice_url,
        'invoice_pdf'             => $this->invoice_pdf,
        'lines_data'              => $this->lines->data,
        'lines_has_more'          => $this->lines->has_more,
        'lines_object'            => $this->lines->object,
        'lines_url'               => $this->lines->url,
        'livemode'                => $this->livemode,
        'metadata'                => $this->metadata,
        'next_payment_attempt'    => $this->next_payment_attempt,
        'number'                  => $this->number,
        'paid'                    => $this->paid,
        'payment_intent'          => $this->payment_intent,
        'period_end'              => $this->period_end,
        'period_start'            => $this->period_start,
        'post_payment_credit_notes_amount'  
                                  => $this->post_payment_credit_notes_amount,
        'pre_payment_credit_notes_amount'   
                                  => $this->pre_payment_credit_notes_amount,
        'receipt_number'          => $this->receipt_number,                     
        'starting_balance' 
                                  => $this->starting_balance,
        'statement_descriptor'    => $this->statement_descriptor,
        'status'                  => $this->status,
        'status_transitions_finalized_at'             
                                  => $this->status_transitions_finalized_at,
        'status_transitions_marked_uncollectible_at'
                                  => $this->status_transitions_marked_uncollectible_at,
        'status_transitions_paid_at'    
                                  => $this->status_transitions_paid_at,
        'status_transitions_voided_at' 
                                  => $this->status_transitions_voided_at,
        'subscription'            => $this->subscription,
        'subtotal'                => $this->subtotal,
        'tax'                     => $this->tax,
        'tax_percent'             => $this->tax_percent,
        'total'                   => $this->total,
        'total_tax_amounts'       => $this->ptotal_tax_amounts,
        'webhooks_delivered_at'   => $this->webhooks_delivered_at,
       ];
    }
}