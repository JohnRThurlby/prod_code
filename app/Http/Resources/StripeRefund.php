<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StripeRefund extends JsonResource
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
            'id'                       => $this->id,
            'object'                   => $this->object,
            'amount'                   => $this->amount,
            'balance_transaction'      => $this->balance_transaction,
            'charge'                   => $this->charge,
            'created'                  => $this->created,
            'currency'                 => $this->currency,
            'metadata'                 => $this->metadata,
            'payment_intent'           => $this->payment_intent,
            'reason'                   => $this->reason,
            'receipt_number'           => $this->receipt_number,
            'source_transfer_reversal' => $this->source_transfer_reversal,
            'status'                   => $this->status,
            'transfer_reversal'        => $this->transfer_reversal,
        ];
    }
}
