<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\BusinessUnit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreStripeUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return $this->user()->can('update', BusinessUnit::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'cardholder_name'   => 'required|string',
            // 'card_number'       => 'required|numeric',
            // 'exp_month'         => 'required|digits_between:1,2',
            // 'exp_year'          => 'required|digits:4',
            // 'cvc_code'          => 'required|digits_between:3,4',
            // 'billing_address'   => 'required|string',
            // 'billing_city'      => 'required|string',
            // 'billing_state'     => 'required|string',
            // 'billing_zip'       => 'required|numeric',
        ];
    }
}
